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
			<span>Ingresar Médico</span>
		</h4>                                
	</div>
	<div class="content">
	<?php 
		$formId = 'frm'.$model;
		
		$url	= CController::createUrl($model.'/guardar');
		$model  = new $model();

		$fModule = new FormularioModule('formulario', 'CWebModule');
		$fModule->beginForm($formId, $this);
		
		echo $fModule->setFormField($model, 'id', 'hidden');
		echo $fModule->setFormField($model, 'identificador', 'textfield');
		echo $fModule->setFormField($model, 'nombre', 'textfield');
		echo $fModule->setFormField($model, 'fe_nacimiento', 'datefield');
		echo $fModule->setFormField($model, 'hr_inicio', 'timefield');
		echo $fModule->setFormField($model, 'hr_fin', 'timefield');
		echo $fModule->setFormField($model, 'estado', 'switch');

		echo $fModule->setFormField($model, $formId, 'defaultbuttons', $url);
		$fModule->endForm();
	?>
	</div>
</div>

<script>
	
	var formId = '<?php echo $formId; ?>';
	$(document).ready(function(){
		// Limpiar y Cancelar
		$('#'+formId+'_cancel').click(function(){
			$('#'+formId).reset();
			$('#formuData').hide();
			$('#listaData').fadeIn('slow');
		});
	});

</script>