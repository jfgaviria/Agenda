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

	function especialidades(request){
		$("#nombre_medico").html(request.nombre);
		$("#id_medico").val(request.id);
		var datos = new Array();
		var iter = 0;
		$.each(request, function(key, val) {
			datos[iter] = val.id_especialidad;
			iter++;
		});
		$("#id_especialidad").val(datos);

		$(".switch").iButton({
			 labelOn: "<span class='icon16 icomoon-icon-checkmark-2 white'></span>",
			 labelOff: "<span class='icon16 icomoon-icon-cancel-3 white'></span>",
			 enableDrag: true
		});
		$(".switch").iButton("repaint");
		
		$('#listaData').hide();
		$('#formuDataE').fadeIn('slow');
	}

	function editar(request){
		$("#frm<?php echo $model;?>").populate(request);
		$(".switch").iButton({
			 labelOn: "<span class='icon16 icomoon-icon-checkmark-2 white'></span>",
			 labelOff: "<span class='icon16 icomoon-icon-cancel-3 white'></span>",
			 enableDrag: true
		});
		$(".switch").iButton("repaint");
		$('#listaData').hide();
		$('#formuData').fadeIn('slow');
	}

	function eliminar(id){
		deleteReg('<?php echo CController::createUrl($model.'/eliminar'); ?>', '<?php echo $model;?>', id);
	}
	
</script>