<?php
/**
 * @name _form
 * Medico
 * 
 * @author juan.gaviria
 */
?>
 <div class="box">
	<div class="title">
		<h4> 
			<span>Especialidades para <span id="nombre_medico"></span></span>
		</h4>                                
	</div>
	<div class="content">
	<?php 
		$formId = 'frm'.$modelE;
		
		$url	= CController::createUrl($modelE.'/guardar');
		$model  = new $modelE();
		
		$especialidades = CHtml::listData(Especialidades::model()->findAll(), 'id', 'descripcion');

		$fModule = new FormularioModule('formulario', 'CWebModule');
		$fModule->beginForm($formId, $this);
		
		echo $fModule->setFormField($model, 'id_medico', 'hidden');
		echo CHtml::activeListBox($model, 'id_especialidad', $especialidades, array('size'=>'6', 'multiple'=>'multiple'));

		echo CHtml::htmlButton('Cancelar', array('id'=>$formId.'_cancel', 'class'=>'marginL10 btn btn-danger'));
		echo CHtml::htmlButton('Guardar', array('id'=>$formId.'_guardar', 'class'=>'marginL10 btn btn-success'));
		
		$fModule->endForm();
	?>
	</div>
</div>

<script>
	
	var formIdE = '<?php echo $formId; ?>';
	$(document).ready(function(){
		// Limpiar y Cancelar
		$('#'+formIdE+'_cancel').click(function(){
			$('#'+formIdE).reset();
			$('#formuDataE').hide();
			$('#listaData').fadeIn('slow');
		});

		// Guardar Especialidades
	});

</script>