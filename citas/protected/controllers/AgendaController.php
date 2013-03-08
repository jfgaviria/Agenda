<?php

class AgendaController extends Controller
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
		$model = $this->id;
		
		$this->render('/site/'.strtolower($model).'/index', array('model'=>$model));
	}
	
	/**
	 * @name actionBuscarPaciente
	 * Busca si el paciente existe y si no solicita el ingreso
	 *
	 * @author juan.gaviria
	 */
	public function actionBuscarPaciente(){
		$post = $_POST;
		
		if(count($post) > 0){
			$paciente = Pacientes::model()->find('identificador=:identificador', array(':identificador'=>$post['identificador']));
			
			if($paciente){
				echo json_encode(array('mensaje'=>'ok', 'id_paciente'=>$paciente->id, 'nombre_paciente'=>$paciente->nombre));
				Yii::app()->end();
			}else{
				echo json_encode(array('mensaje'=>'no'));
				Yii::app()->end();
			}
		}else{
			echo json_encode(array('error'=>'No se enviaron datos'));
			Yii::app()->end();
		}
	}
	
	/**
	 * @name actionBuscarMedico
	 * Busca los mŽdicos por especialidad
	 *
	 * @author juan.gaviria
	 */
	public function actionBuscarMedico(){
		$post = $_POST;
		
		if(count($post) > 0){
			$medicos = EspecialidadesMedicos::model()->findAll('id_especialidad=:id_especialidad', array(':id_especialidad'=>$post['id_especialidad']));

			if(count($medicos) > 0){
				$medicos = CHtml::listData($medicos, 'idMedico.id', 'idMedico.nombre');
				
				$options = CHtml::tag('option', array('value'=>''), CHtml::encode('Seleccione...'), true);
				foreach($medicos AS $value=>$name){
					$options .= CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
				}
				
				echo json_encode(array('mensaje'=>'ok', 'medicos'=>$options));
			}else{
				echo json_encode(array('mensaje'=>'No se encontraron resultados con la especialidad seleccionada.'));
				Yii::app()->end();
			}
		}else{
			echo json_encode(array('error'=>'No se enviaron datos'));
			Yii::app()->end();
		}
	}

	/**
	 * @name actionBuscarDisponibilidad
	 * Busca la disponibilidad del medico para asignar la cita
	 *
	 * @author juan.gaviria
	 */
	public function actionBuscarDisponibilidad(){
		$post = $_POST;
		
		if(count($post) > 0){
			$medico = Medicos::model()->findByPk($post['id_medico']);
			$fecha  = explode('-', $post['id_fecha']);
			$agenda = Agenda::model()->findAll('id_medico=:id_medico 
												AND YEAR(fe_inicial) = :year
												AND MONTH(fe_inicial) = :month 
												AND DAY(fe_inicial) = :day', 
												array(':id_medico'=>$post['id_medico'], ':year'=>$fecha[0], ':month'=>$fecha[1], ':day'=>$fecha[2]));
			
			$horaInicial = strtotime(date("Y-m-d").' '.$medico->hr_inicio);
			$horaFinal 	 = strtotime(date("Y-m-d").' '.$medico->hr_fin);
			$horarios	 = array();
			$excluir	 = false;
			for($i = $horaInicial; $i < $horaFinal; $i += 1800){
				if(count($agenda) > 0){
					foreach($agenda AS $ag){
						echo json_encode(array('error'=>print_r(strtotime($ag->fe_inicial) .'||'. $i, true)));
						if(strtotime($ag->fe_inicial) == $i || strtotime($ag->fe_final) == $i){
							$excluir = true;
						}
						$excluir = false;
					}
				}
				if(!$excluir)
					$horarios[] = date("H:i:s", $i);
			}
			
			echo json_encode(array('error'=>print_r($horarios, true)));
		}else{
			echo json_encode(array('error'=>'No se enviaron datos'));
			Yii::app()->end();
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