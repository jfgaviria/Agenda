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
			$fecha  = explode('-', $post['id_fecha']);
			
			$wd = date('N', strtotime($post['id_fecha']));
			if($wd == 6 || $wd == 7){
				echo json_encode(array('error'=>'No se pueden asignar citas los fines de semana'));
				Yii::app()->end();
			}
			
			$medico = Medicos::model()->findByPk($post['id_medico']);
			$agenda = Agenda::model()->findAll('id_medico=:id_medico 
												AND YEAR(fe_inicial) = :year
												AND MONTH(fe_inicial) = :month 
												AND DAY(fe_inicial) = :day', 
												array(':id_medico'=>$post['id_medico'], ':year'=>$fecha[0], ':month'=>$fecha[1], ':day'=>$fecha[2]));
			$hrOcupadas = array();
			if(count($agenda) > 0){
				foreach($agenda AS $ag){
					$hrOcupadas[strtotime($ag->fe_inicial)] = $ag->fe_inicial;
				}
			}
			$hrOcupadas = array_keys($hrOcupadas);
			
			$horaInicial = strtotime(date("Y-m-d").' '.$medico->hr_inicio);
			$horaFinal 	 = strtotime(date("Y-m-d").' '.$medico->hr_fin);
			$horarios	 = array();
			for($i = $horaInicial; $i < $horaFinal; $i += 1800){
				if(!in_array($i, $hrOcupadas))
					$horarios[date("H:i:s", $i)] = date("H:i:s", $i);
			}
			
			$options = CHtml::tag('option', array('value'=>''), CHtml::encode('Seleccione...'), true);
			foreach($horarios AS $value=>$name){
				$options .= CHtml::tag('option', array('value'=>$value), CHtml::encode($name), true);
			}
			
			echo json_encode(array('mensaje'=>'ok', 'html'=>$options));
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
		$post = $_POST;
		$post['fe_final'] = date('Y-m-d H:i:s', strtotime($post['fe_inicial']) + 1800);
		
		try{
			$model = new Agenda;
			$model->setAttributes($post);
			
			if($model->validate()){
				if($model->save()){
					echo json_encode(array('mensaje'=>'La cita se ha agendado correctamente.'));
					Yii::app()->end();
				}else{
					echo json_encode(array('error'=>CHtml::errorSummary($model)));
					Yii::app()->end();
				}
			}else{
				echo json_encode(array('error'=>CHtml::errorSummary($model)));
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
}	