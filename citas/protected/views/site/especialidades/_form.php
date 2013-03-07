<?php
/**
 * @name _form
 * Especialidad
 * 
 * @author juan.gaviria
 */
?>
 <div class="box">
	<div class="title">
		<h4> 
			<span>Ingresar Especialidad</span>
		</h4>                                
	</div>
	<div class="content">
	<?php 
		$formId = 'frm'.$model;
		
		$url	= CController::createUrl($model.'/guardar');
		$model  = new $model();

		$fModule = new FormularioModule('formulario', 'CWebModule');
		$fModule->beginForm($formId, $this);
		
		$hidden  	 = array('id');
		$exclude 	 = array();
		$fieldParams = array();
		$fields = $fModule->renderForm($model, $hidden, $exclude, $fieldParams);
		foreach($fields AS $field){
			echo $field;
		}

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