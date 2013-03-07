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
        <?php echo $form->label($model,'varname', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'varname',array('size'=>50,'maxlength'=>50)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'title', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'field_type', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->dropDownList($model,'field_type',ProfileField::itemAlias('field_type')); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'field_size', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'field_size'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'field_size_min', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'field_size_min'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'required', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->dropDownList($model,'required',ProfileField::itemAlias('required')); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'match', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'match',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'range', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'range',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'error_message', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'error_message',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'other_validator', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'other_validator',array('size'=>60,'maxlength'=>5000)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'default', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'default',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'widget', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'widget',array('size'=>60,'maxlength'=>255)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'widgetparams', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'widgetparams',array('size'=>60,'maxlength'=>5000)); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'position', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->textField($model,'position'); ?>
        </div>
    </div>

    <div class="form-row">
        <?php echo $form->label($model,'visible', array('class'=>'form-label')); ?>
        <div class="form-item">
        <?php echo $form->dropDownList($model,'visible',ProfileField::itemAlias('visible')); ?>
        </div>
    </div>

    <div class="form-row buttons">
        <?php echo CHtml::submitButton(UserModule::t('Buscar'), array('class'=>'button green')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form --> 