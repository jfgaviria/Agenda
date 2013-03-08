<?php

class EspecialidadesMedicosController extends Controller
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
	 * @name actionGuardar
	 * Guardar Formulario
	 *
	 * @author juan.gaviria
	 */
	public function actionGuardar(){
		$post = $_POST;
		
		try{
			$guardados = 0;
			foreach ($post['especialidades'] AS $especialidad){
				$espMedico = EspecialidadesMedicos::model()->find('id_medico=:id_medico AND id_especialidad=:id_especialidad', 
																	array(':id_medico'=>$post['id_medico'], ':id_especialidad'=>$especialidad));
				if(!$espMedico){
					$model_espMedico = new EspecialidadesMedicos;
					$model_espMedico->id_medico = $post['id_medico'];
					$model_espMedico->id_especialidad = $especialidad;
					
					if($model_espMedico->validate()){
						if($model_espMedico->save()){
							$guardados++;
						}else{
							echo json_encode(array('error'=>CHtml::errorSummary($model_espMedico)));
							Yii::app()->end();
						}
					}else{
						echo json_encode(array('error'=>CHtml::errorSummary($model_espMedico)));
						Yii::app()->end();
					}
				}
			}
			if($guardados > 0){
				echo json_encode(array('mensaje'=>'Se han guardado los datos correctamente.'));
				Yii::app()->end();
			}else{
				echo json_encode(array('mensaje'=>'No hay datos para guardar.'));
				Yii::app()->end();
			}
		}catch (CException $cex){
			echo json_encode(array('error'=>$cex->getMessage()));
		}catch (CHttpException $he){
			echo json_encode(array('error'=>$he->getMessage()));
		}catch (CDbException $dbe){
			echo json_encode(array('error'=>$dbe->getMessage()));
		}
		
// 		parent::guardarDatos($_POST);
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