<?php

class PacientesController extends Controller
{	
	/**
	 * @name init
	 * Verifica si el usuario esta loggeado
	 * 
	 * @author juan.gaviria
	 */
	function init(){
		if(Yii::app()->user->isGuest){
			$this->redirect(Yii::app()->getModule('user')->loginUrl);
		}
	}

	/**
	 * @name actionIndex
	 * Funcion principal
	 * 
	 * @author juan.gaviria
	 */
	public function actionIndex(){
		try{
			$model = $this->id;
			
			// Columns
			$columns = array(
					'id',
					'identificador:text',
					'nombre:text',
					'fe_nacimiento:text',
					'telefono:text',
					'observaciones:text',
					'buttons' => array(
						'class' => 'ext.EDataTables.EButtonColumn',
						'template' => '{editar} {eliminar}',
						'header' => Yii::t('app','Operaciones'),
						'buttons' => array(
							'editar' => array(
								'label'=>'<span class="icon16 icomoon-icon-pencil white"></span>',
								'imageUrl'=>false,
								'url'=>'"javascript:editar(" . json_encode($data->getAttributes()) . ")"',
        						'options'=>array('class'=>'btn btn-warning btn-mini'),
							),
							'eliminar' => array(
								'label' => '<span class="icon16 icomoon-icon-remove white"></span>',
								'imageUrl' => false,
								'url'=>'"javascript:eliminar(\'".$data->id."\')"',
								'options' => array('class'=>'btn btn-danger btn-mini',),
							),
						),
					),
			);
			// Criteria
			$criteriaWith = array();
			// Search Text Fields
			$conditions = array(
				array('field'=>'t.identificador', 'scape'=>true, 'operator'=>'OR', 'like'=>'LIKE'),
				array('field'=>'t.nombre', 'scape'=>true, 'operator'=>'OR', 'like'=>'LIKE'),
				array('field'=>'t.fe_nacimiento', 'scape'=>true, 'operator'=>'OR', 'like'=>'LIKE'),
				array('field'=>'t.telefono', 'scape'=>true, 'operator'=>'OR', 'like'=>'LIKE'),
				array('field'=>'t.observaciones', 'scape'=>true, 'operator'=>'OR', 'like'=>'LIKE'),
			);
			// Sorting
			$sortableColumnNamesArray = array(
// 					'defaultOrder'=>'id',
					'id',
					'descripcion',
			);
			// AJAX URL
			$ajaxUrl = CController::createAbsoluteUrl($model);
			
			ListadoModule::setThis($this);
			$widget = ListadoModule::insertDataTable($model, $columns, $conditions, $criteriaWith, $sortableColumnNamesArray, $ajaxUrl, 'responsive display table table-bordered');
			
			if(!Yii::app()->getRequest()->getIsAjaxRequest()){
				if(isset($_GET['print']) && $_GET['print'] == 1){
					ListadoModule::exportDataTable();
				}else{
					$this->render('/site/'.strtolower($model).'/index', array('widget'=>$widget, 'model'=>$model));
				}
				return;
			}else{
				echo json_encode($widget->getFormattedData($_REQUEST['sEcho']));
				Yii::app()->end();
			}
		}catch (CException $cex){
			echo json_encode(array('error'=>$cex->getMessage()));
		}catch (CHttpException $he){
			echo json_encode(array('error'=>$he->getMessage()));
		}catch (CDbException $dbe){
			echo json_encode(array('error'=>$dbe->getMessage()));
		}
	}

	/**
	 * @name actionGuardar
	 * Guardar Formulario
	 *
	 * @author juan.gaviria
	 */
	public function actionGuardar(){
		parent::guardarDatos($_POST);
	}
	
	/**
	 * @name actionEliminar
	 * Guardar Formulario
	 *
	 * @author juan.gaviria
	 */
	public function actionEliminar(){
		parent::eliminarDatos($_POST);
	}
}	