<?php
/**
 * @name index
 * Panel de Control
 * 
 * @author juan.gaviria
 */
$subtitle = $model;
$this->pageTitle=Yii::app()->name . ' - ' . $subtitle;
$this->breadcrumbs=array(
		ucfirst($this->id), $subtitle,
);
?>
<div class="row-fluid">
	<div class="span12">

		<!-- Formulario -->
		<div id="formuData" style="display: none;" >
			<?php $this->renderPartial('/site/'.strtolower($model).'/_form', array('model'=>$model)); ?>
		</div>
		<!-- FIN Formulario -->
		
		<!-- Formulario style="display: none;"-->
		<div id="formuDataE"  >
			<?php $this->renderPartial('/site/'.strtolower($model).'/_especialidades', array('modelE'=>$modelE)); ?>
		</div>
		<!-- FIN Formulario -->
		
		<!-- Listado -->
		<div id="listaData">
			<div class="content noPad clearfix">
				<?php $this->renderPartial('/site/'.strtolower($model).'/_list', array('widget'=>$widget, 'model'=>$model, 'modelE'=>$modelE)); ?>
			</div>
		</div>
		<!-- FIN Listado -->

	</div>
</div>

<script>
	$(document).ready(function(){
		$('#nuevoDato').click(function(){
			$('#listaData').hide();
			$(".switch").iButton({
				 labelOn: "<span class='icon16 icomoon-icon-checkmark-2 white'></span>",
				 labelOff: "<span class='icon16 icomoon-icon-cancel-3 white'></span>",
				 enableDrag: true
			});
			$("div.checker span").css('background', 'none');
			$('#formuData').fadeIn('slow');
		});
	});
</script>