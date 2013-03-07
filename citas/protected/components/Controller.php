<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	
	public function filters(){
		return array(
			'rights',
		);
	}
	
	
	/**
	 * @name guardarDatos
	 * Funci�n Global para Guardar los datos de un Formulario
	 * inclusive en diferentes tablas
	 *
	 * @author juan.gaviria
	 */
	public function guardarDatos($post = array()){
		try{
			if(count($post) > 0){
				foreach($post AS $key=>$value){
					$strmodel = $key;
					$datos 	  = $value;
					$errors	  = 0;
					$model 	  = new $strmodel();
					$pKey	  = $model->tableSchema->primaryKey;
					if(count($datos) > 0){
						if(isset($datos[$pKey]) && $datos[$pKey] != ''){
							$model = $model->findByPk($datos[$pKey]);
							$model->attributes = $datos;
							if($model->validate()){
								if(!$model->save()){
									$errors++;
								}
							}else{
								$errors++;
							}
						}else{
							$model = new $strmodel();
							$model->attributes = $datos;
							if($model->validate()){
								if(!$model->save()){
									$errors++;
								}
							}else{
								echo json_encode(array('error'=>CHtml::errorSummary($model)));
								Yii::app()->end();
							}
						}
						if($errors > 0){
							echo json_encode(array('error'=>CHtml::errorSummary($model)));
							Yii::app()->end();
						}
					}else{
						echo json_encode(array('error'=>'No se enviaron datos.'));
						Yii::app()->end();
					}
				}
				echo json_encode(array('mensaje'=>'Se han guardado los datos correctamente.'));
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
	 * @name eliminarDatos
	 * Elimina los datos del ID o de los ID (array()) que se pasen en el POST
	 *
	 * @author juan.gaviria
	 */
	public function eliminarDatos($post = array()){
		try{
			if(count($post) > 0){
				$strModel 	= $post['model'];
				$model 	  	= new $strModel();
				$pKey	  	= $model->tableSchema->primaryKey;
				$eliminados = 0;

				if($model->deleteByPk($post[$pKey])){
					echo json_encode(array('mensaje'=>'El registro se ha eliminado correctamente.'));
					Yii::app()->end();
				}else{
					echo json_encode(array('error'=>'Ocurri� un error al tratar de eliminar el registro.'));
					Yii::app()->end();
				}
			}else{
				echo json_encode(array('error'=>'No se enviaron datos.'));
			}
		}catch (CException $cex){
			echo json_encode(array('error'=>$cex->getMessage()));
		}catch (CHttpException $he){
			echo json_encode(array('error'=>$he->getMessage()));
		}catch (CDbException $dbe){
			echo json_encode(array('error'=>$dbe->getMessage()));
		}
	}
}