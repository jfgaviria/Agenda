<?php

class ListadoModule extends CWebModule
{
	static private $_this = null;
	static private $_sSearch = null;
	static private $_model = null;
	static private $_columns = null;
	static private $_criteria = null;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'listado.models.*',
			'listado.components.*',
			'listado.widgets.*'
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public static function setThis($this){
		self::$_this = $this;
	}
	
	public static function wDialog($id, $title, $botones = array(), $autoOpen = false, $modal = true, $width = 550, $height = 'auto'){
		self::$_this->beginWidget('zii.widgets.jui.CJuiDialog', array(
				'id'=>$id,
				'options'=>array(
						'title'=>$title,
						'autoOpen'=>$autoOpen,
						'modal'=>$modal,
						'width'=>$width,
						'height'=>$height,
						'buttons' => count($botones) > 0 ? $botones : array('Cerrar'=>'js:function(){$(this).dialog("close")}')
				),
		));
		 
		echo '<div class="divAlerta"></div>';
		 
		self::$_this->endWidget('zii.widgets.jui.CJuiDialog');
	}
	
	public static function insertDataTable($model, $columns = array(), $conditions = array(), $criteriaWith = array(), $sortableColumnNamesArray = array(), $ajaxUrl = '', $itemsCssClass = 'dataTable'){
		self::$_model = $model;
		self::$_columns = $columns;
		
		// Criteria
		$criteria = new CDbCriteria;
		if(count($criteriaWith) > 0){
			$criteria->with = $criteriaWith;
		}
		// Search Text Fields
		$_SESSION['sSearch'] = isset($_REQUEST['print']) && $_REQUEST['print'] == 1 ? $_SESSION['sSearch'] : (isset($_REQUEST['sSearch']) ? $_REQUEST['sSearch'] : null);
		self::$_sSearch = $_SESSION['sSearch'];
		if(count($conditions) > 0){
			$condAND = '';
			$condOR = array();
			foreach($conditions AS $condition){
				$value = null;
				if(isset($condition['value']) && $condition['value'] != ''){
					$condAND = $condition['field'] .' '.$condition['like'].' '. $condition['value'];
				}else if(isset(self::$_sSearch{0})){
					if($condition['scape'])
						$sSearch = '\'%' . strtr(self::$_sSearch, array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')) . '%\'';
					$condOR[] = $condition['field'] .' '.$condition['like'].' '. $sSearch;
				}
			}
			$condAND = $condAND != '' && count($condOR) > 0 ? '('.$condAND.') AND ' : $condAND ;
			$condOR  = count($condOR) > 0 ? '('.implode(' OR ', $condOR).')' : '';
			$criteria->condition = $condAND . $condOR;
		}else{
			$criteria->addSearchCondition('t.id', self::$_sSearch, false, 'OR', '=');
		}
		$_SESSION['criteria'] = $criteria;
		self::$_criteria = $_SESSION['criteria'];
		
		// Sorting
		$defaultOrder = null;
		if(count($sortableColumnNamesArray) > 0){
			if(isset($sortableColumnNamesArray['defaultOrder']) && $sortableColumnNamesArray['defaultOrder'] != ''){
				$defaultOrder = $sortableColumnNamesArray['defaultOrder'];
				unset($sortableColumnNamesArray['defaultOrder']);
			}
			$sort = new EDTSort($model, $sortableColumnNamesArray);
			if(!is_null($defaultOrder))
				$sort->defaultOrder = $defaultOrder;
		}
		// Pagination
		$pagination = new EDTPagination();
		$pagination->setPageSize(Yii::app()->params['pageSize']);
		// Data Provider
		$dataProvider = new CActiveDataProvider($model, array(
				'criteria'		=> $criteria,
				'pagination'	=> $pagination,
				'sort'			=> $sort,
		));
		
		// Widget responsive dataTable para CGridView
		$ajaxUrl = $ajaxUrl != '' ? $ajaxUrl : Yii::app()->getBaseUrl().'/index.php'.ucfirst($model).'/index';
		$widget = self::$_this->createWidget('ext.EDataTables.EDataTables', array(
				'id'				=> strtolower($model).'-list',
				'dataProvider'		=> $dataProvider,
				'ajaxUrl'			=> $ajaxUrl,
				'datatableTemplate' => '<"H"fr>t<"F"ip>',
				'itemsCssClass' 	=> $itemsCssClass,
				'columns'			=> $columns,
				'bootstrap'			=> false, 
		));
				
		return $widget;
	}
	
	public static function exportDataTable(){
		$strModel = self::$_model;
		
		$dataProvider = new CActiveDataProvider($strModel, array(
				'criteria' 		=> self::$_criteria,
				'pagination'	=> false,
		));
		$model = $dataProvider->model;
		$attributes = $model->getAttributes();
		
		// Get Model Data
		$data = $dataProvider->getData();
		
		//
		// get a reference to the path of PHPExcel classes
		$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');
		
		// Turn off our amazing library autoload
		spl_autoload_unregister(array('YiiBase','autoload'));
		
		//
		// making use of our reference, include the main class
		// when we do this, phpExcel has its own autoload registration
		// procedure (PHPExcel_Autoloader::Register();)
		include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set properties
		$objPHPExcel->getActiveSheet()->setTitle($strModel);
		
		$columns = self::$_columns;
		unset($columns['buttons']);
		$newColumns = array();
		foreach ($columns AS $col){
			if(is_array($col))
				$col = $col['name'];
		
			if(!preg_match('/^([\w\.]+)(:(\w*))?(:(.*))?$/',$col,$matches))
				throw new Exception(Yii::t('zii','The column must be specified in the format of "Name:Type:Label", where "Type" and "Label" are optional.'));
		
			if(strstr($matches[1], '.'))
				$matches[1] = explode('.', $matches[1]);
				
			$newColumns[] = $matches[1];
		}
		
		$headings = array();
		foreach($newColumns AS $colName){
			$rel = null;
			//@todo Modificar este script para que pueda profundizar en mas relaciones
			if(is_array($colName)){
				$rel  = $data[0]->getRelated($colName[0]);
				$headings[] = utf8_encode($rel->getAttributeLabel($colName[1]));
			}else{
				$headings[] = utf8_encode($data[0]->getAttributeLabel($colName));
			}
		}
		
		$rowNumber = 1;
		$col = 'A';
		foreach($headings as $heading) {
			$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading);
			$col++;
		}
		
		$rowNumber = 2;
		foreach($data AS $d){
			$col = 'A';
			foreach($newColumns AS $colName){
				$rel = null;
				if(is_array($colName)){
					$rel = $d->getRelated($colName[0]);
					$cell = $rel->$colName[1];
				}else{
					$cell = $d->$colName;
				}
				$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell);
				$col++;
			}
			$rowNumber++;
		}
		
		// Freeze pane so that the heading line won't scroll
		$objPHPExcel->getActiveSheet()->freezePane('A2');
		
		// Save as an Excel BIFF (xls) file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		
		// Redirect output to a clientÕs web browser (Excel2007)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$strModel.'.xls"');
		header('Cache-Control: max-age=0');
		
		$objWriter->save('php://output');
		Yii::app()->end();
		
		//
		// Once we have finished using the library, give back the
		// power to Yii...
		spl_autoload_register(array('YiiBase','autoload'));
	}
	
	public static function getSsearch(){
		return self::$_sSearch;
	}
}
