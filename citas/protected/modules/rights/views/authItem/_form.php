<div class="form span-12 first">

<?php if( $model->scenario==='update' ): ?>

	<h3><?php echo Rights::getAuthItemTypeName($model->type); ?></h3>

<?php endif; ?>
	
<?php $form=$this->beginWidget('CActiveForm'); ?>

	<div class="form-row">
		<?php echo $form->labelEx($model, 'name', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->textField($model, 'name', array('maxlength'=>255, 'class'=>'text-field')); ?>
		</div>
		<?php echo $form->error($model, 'name'); ?>
		<p class="hint"><?php echo Rights::t('core', 'Do not change the name unless you know what you are doing.'); ?></p>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model, 'description', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->textField($model, 'description', array('maxlength'=>255, 'class'=>'text-field')); ?>
		</div>
		<?php echo $form->error($model, 'description'); ?>
		<p class="hint"><?php echo Rights::t('core', 'A descriptive name for this item.'); ?></p>
	</div>

	<?php if( Rights::module()->enableBizRule===true ): ?>

		<div class="form-row">
			<?php echo $form->labelEx($model, 'bizRule', array('class'=>'form-label')); ?>
			<div class="form-item">
			<?php echo $form->textField($model, 'bizRule', array('maxlength'=>255, 'class'=>'text-field')); ?>
			</div>
			<?php echo $form->error($model, 'bizRule'); ?>
			<p class="hint"><?php echo Rights::t('core', 'Code that will be executed when performing access checking.'); ?></p>
		</div>

	<?php endif; ?>

	<?php if( Rights::module()->enableBizRule===true && Rights::module()->enableBizRuleData ): ?>

		<div class="form-row">
			<?php echo $form->labelEx($model, 'data', array('class'=>'form-label')); ?>
			<div class="form-item">
			<?php echo $form->textField($model, 'data', array('maxlength'=>255, 'class'=>'text-field')); ?>
			</div>
			<?php echo $form->error($model, 'data'); ?>
			<p class="hint"><?php echo Rights::t('core', 'Additional data available when executing the business rule.'); ?></p>
		</div>

	<?php endif; ?>

	<div class="form-row buttons">
		<?php echo CHtml::submitButton(Rights::t('core', 'Save'), array('class'=>'button green')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancelar'), Yii::app()->user->rightsReturnUrl); ?>
	</div>

<?php $this->endWidget(); ?>

</div>