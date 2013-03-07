<div class="form">

<?php $form=$this->beginWidget('CActiveForm'); ?>
	
	<div class="form-row">
		<div class="form-item">
		<?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
		</div>
		<?php echo $form->error($model, 'itemname'); ?>
	</div>
	
	<div class="form-row buttons">
		<?php echo CHtml::submitButton(Rights::t('core', 'Assign'), array('class'=>'button green')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>