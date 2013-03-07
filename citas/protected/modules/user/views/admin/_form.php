<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="form-row">
		<?php echo $form->labelEx($model,'username', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		</div>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model,'password', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)); ?>
		</div>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model,'email', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		</div>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model,'superuser', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		</div>
		<?php echo $form->error($model,'superuser'); ?>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model,'status', array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		</div>
		<?php echo $form->error($model,'status'); ?>
	</div>
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="form-row">
		<?php echo $form->labelEx($profile,$field->varname, array('class'=>'form-label')); ?>
		<div class="form-item">
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo CHtml::activeTextArea($profile,$field->varname,array('form-rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		 </div>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>
			<?php
			}
		}
?>
	<div class="form-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save'), array('class'=>'button green')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->