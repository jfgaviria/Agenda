<?php
/**
 * @name _list
 * Medicos
 * 
 * @author juan.gaviria
 */
	echo CHtml::link('<span class="icon16 icomoon-icon-pencil white">Adicionar</span>', 'javascript:;', array('id'=>'nuevoDato', 'class'=>'btn btn-primary marginB10'));
	
	$widget->run();
	ListadoModule::wDialog('alerta', 'Atencion', array(
			'Cancelar'=>'js:function(){$(this).dialog("close"); location.reload();}'
		)
	);
?>
<script>

	function editar(request){
		$("#frm<?php echo $model;?>").populate(request);
		$('#listaData').hide();
		$('#formuData').fadeIn('slow');
	}

	function eliminar(id){
		deleteReg('<?php echo CController::createUrl($model.'/eliminar'); ?>', '<?php echo $model;?>', id);
	}
	
</script>