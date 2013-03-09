<?php
/**
 * @name index
 * Panel de Control
 * 
 * @author juan.gaviria
 */
$subtitle = ucfirst($model);
$this->pageTitle=Yii::app()->name . ' - ' . $subtitle;
$this->breadcrumbs=array(
		ucfirst($this->id), $subtitle,
);

$pacientes = CHtml::listData(Pacientes::model()->findAll(array('order'=>'nombre')), 'id', 'nombre');
?>
<div class="row-fluid">
	<div class="span12">

		<div class="box">
			<div class="title">
				<h4> 
					<span>Programar Citas</span>
				</h4>
			</div>
			<div class="content">
				<?php echo CHtml::htmlButton('Nueva Cita', array('id'=>'nueva_cita', 'class'=>'btn btn-primary')); ?>
				
				<span id="ds_medico" class="label label-inverse right marginR5" style="display: none;" ></span>
				<span id="ds_especialidad" class="label label-success right marginR5" style="display: none;" ></span>
				<span id="nombre_paciente" class="label label-info right marginR5" style="display: none;" ></span>
				
				<form class="horizontal" id="frmCitas" action="<?php echo CController::createUrl('Agenda/guardar'); ?>">
					<div class="form-row row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<div class="span8 controls"> 
									<div class="input-append">
									<?php
										echo CHtml::label('Paciente', 'identificador'); 
										echo CHtml::hiddenField('id_paciente');
										echo CHtml::textField('identificador', '', array('class'=>'span4 tip', 'title'=>'Puede buscar un paciente por el Identificador'));
										echo CHtml::htmlButton('Buscar', array('id'=>'buscar_paciente', 'class'=>'btn btn-info')) 
									?>
									</div>
								</div>
							</div>	
							<div class="row-fluid" id="rowEspecialidad" style="display: none;">
								<div class="grid-inputs span4">
									<?php 
										$especialidades = CHtml::listData(Especialidades::model()->findAll(), 'id', 'descripcion');
										
										echo CHtml::label('Especialidad', 'id_especialidad');
										echo CHtml::dropDownList('id_especialidad', '', $especialidades, array('id'=>'id_especialidad', 'class'=>'select', 'prompt'=>'Seleccione...'));
									?>
								</div>
							</div>
							<div class="row-fluid" id="rowMedico" style="display: none;">
								<div class="grid-inputs span4">
									<?php 
										echo CHtml::label('M&eacute;dico', 'id_medico');
										echo CHtml::dropDownList('id_medico', '', array(), array('id'=>'id_medico', 'class'=>'select', 'prompt'=>'Seleccione...'));
									?>
								</div>
							</div>
							<div class="row-fluid" id="rowFecha" style="display: none;">
								<div class="grid-inputs span4">
									<?php 
										echo CHtml::label('Fecha', 'id_fecha');
										echo CHtml::textField('id_fecha', '', array('id'=>'id_fecha', 'class'=>'datefield'));
									?>
								</div>
							</div>
							<div class="row-fluid" id="rowDisponibilidad" style="display: none;">
								<div class="grid-inputs span4">
									<?php 
										echo CHtml::label('Disponibilidad', 'fe_inicial');
										echo CHtml::dropDownList('fe_inicial', '', array(), array('id'=>'fe_inicial', 'class'=>'select', 'prompt'=>'Seleccione...'));
									?>
								</div>
							</div>
							<div class="row-fluid" id="rowBotones" style="display: none;">
								<div class="grid-inputs span4">
									<?php 
										echo CHtml::htmlButton('Guardar Cita', array('id'=>'guardar_cita', 'class'=>'btn btn-success marginT10'));
									?>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$("#nueva_cita").click(function(){
			window.location.href = document.location.href;
		});
		
		$("#buscar_paciente").click(function(){
			if($("#ds_paciente").val() == ''){
				alert('Debe ingresar un criterio a buscar.');
				return false;
			}

			$.post('<?php echo CController::createUrl('Agenda/buscarPaciente'); ?>', {
				identificador: $("#identificador").val()
			}, function(response){
				var data = $.parseJSON(response);

				if(data.error){
					alert(data.error); return false;
				}
				if(data.mensaje){
					if(data.mensaje == 'ok'){
						$("#id_paciente").val(data.id_paciente);
						$("#nombre_paciente").html(data.nombre_paciente).fadeIn();
						$("#rowEspecialidad").fadeIn();
					}else{
						if(confirm('El Paciente a buscar no existe. Desea ingresar un nuevo paciente?')){
							window.location.href = '<?php echo CController::createUrl('/Pacientes'); ?>';
						}
					}
				}
			});
		});

		$("#id_especialidad").change(function(){
			$.post('<?php echo CController::createUrl('Agenda/buscarMedico'); ?>', {
				id_especialidad: $("#id_especialidad").val()
			}, function(response){
				var data = $.parseJSON(response);

				if(data.error){
					alert(data.error); return false;
				}
				if(data.mensaje){
					if(data.mensaje == 'ok'){
						$("#ds_especialidad").html($("#id_especialidad option:selected").text()).fadeIn();
						$("#id_medico").html(data.medicos);
						$("#rowMedico").fadeIn();
					}else{
						alert(data.mensaje); return false;
					}
				}
			});
		});

		$("#id_medico").change(function(){
			$("#ds_medico").html($("#id_medico option:selected").text()).fadeIn();
			$("#rowFecha").fadeIn();
		});
		
		$("#id_fecha").change(function(){
			$.post('<?php echo CController::createUrl('Agenda/buscarDisponibilidad'); ?>', {
				id_medico: $("#id_medico").val(),
				id_fecha : $("#id_fecha").val()
			}, function(response){
				var data = $.parseJSON(response);

				if(data.error){
					alert(data.error); return false;
				}
				if(data.mensaje){
					if(data.mensaje == 'ok'){
						$("#fe_inicial").html(data.html);
						$("#rowDisponibilidad").fadeIn();
					}else{
						alert(data.mensaje); return false;
					}
				}
			});
		});

		$("#fe_inicial").change(function(){
			if($(this).val() != ''){
				$("#rowBotones").fadeIn();
			}else{
				$("#rowBotones").hide();
			}
		});
		
		$("#guardar_cita").click(function(){
			if(confirm('Esta seguro de querer agendar esta cita?')){
				$.post('<?php echo CController::createUrl('Agenda/guardar'); ?>', {
					id_paciente: $("#id_paciente").val(),
					id_medico  : $("#id_medico").val(),
					fe_inicial : $("#id_fecha").val() + " " + $("#fe_inicial").val()
				}, function(response){
					var data = $.parseJSON(response);

					if(data.error){
						alert(data.error); return false;
					}
					if(data.mensaje){
						alert(data.mensaje);
						window.location.href = document.location.href;
					}
				});
			}
		});
		
	});
</script>