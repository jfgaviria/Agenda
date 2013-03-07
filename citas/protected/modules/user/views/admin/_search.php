<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <div class="form-row">
        <?php echo $form->label($model,'id', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'id'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'username', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'email', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'activkey', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'activkey',array('size'=>60,'maxlength'=>128)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'create_at', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'create_at'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'lastvisit_at', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'lastvisit_at'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'superuser', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->dropDownList($model,'superuser',$model->itemAlias('AdminStatus')); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'status', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->dropDownList($model,'status',$model->itemAlias('UserStatus')); ?>
        </div>
    </div>

    <div class="form-row buttons">
        <?php echo CHtml::submitButton(UserModule::t('Buscar'), array('class'=>'button green')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->