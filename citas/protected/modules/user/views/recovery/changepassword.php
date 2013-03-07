<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Change Password");
$this->breadcrumbs=array(
	UserModule::t("Login") => array('/user/login'),
	UserModule::t("Change Password"),
);
?>

	<div class="wrapper">
		<div class="logo">
			<h1>RECUPERAR</h1>
		</div>
		<div class="lg-body">
			<div class="inner">
				<div id="lg-head">
					<p><span class="font-bold">Coljuegos</span>: Genere una nueva contrase&ntilde;a.</p>
					<div class="separator"></div>
				</div>
				<div class="login">
					<?php echo CHtml::beginForm(); ?>
						<?php echo CHtml::errorSummary($form, '', '', array('class'=>'errorSummary')); ?>
						
						<ul>
							<li id="psw-field">
								<?php echo CHtml::activePasswordField($form,'password', array('class'=>'input required', 'placeholder'=>UserModule::t('password'))); ?>
								<span id="usr-field-icon"></span>
							</li>
						
							<li id="psw-field">
								<?php echo CHtml::activePasswordField($form,'verifyPassword', array('class'=>'input required', 'placeholder'=>UserModule::t('Retype Password'))); ?>
								<span id="psw-field-icon"></span>
							</li>

							<li>
								<?php echo CHtml::submitButton(UserModule::t("Save"), array('class'=>'submit button green')); ?>
							</li> 
						</ul>
					
					<?php echo CHtml::endForm(); ?>
				</div>
			</div>
		</div>
    </div>