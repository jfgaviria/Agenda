<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Restore");
?>
	<div class="wrapper">
		<div class="logo">
	 	<h1>RECUPERAR</h1>
	 </div>
   <div class="lg-body">
     <div class="inner">
       <div id="lg-head">
         <p><span class="font-bold">Coljuegos</span>: Por favor ingrese su usuario o email.</p>
         <div class="separator"></div>
       </div>
       <div class="login">
			<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
			<div class="success">
			<?php echo Yii::app()->user->getFlash('recoveryMessage'); ?>
			</div>
			<?php else: ?>
			
	
			<?php echo CHtml::beginForm(); ?>
				<?php echo CHtml::errorSummary($form, '', '', array('class'=>'errorSummary')); ?>
				
				<ul>
					<li id="usr-field"><?php echo CHtml::activeTextField($form,'login_or_email',array('class'=>'input required', 'placeholder'=>UserModule::t('login_or_email'), 'autocomplete'=>'off', 'title'=>UserModule::t("Please enter your login or email addres."))); ?><span id="usr-field-icon"></span></li>
					<li><?php echo CHtml::htmlButton(UserModule::t("Restore"),array('type'=>'submit', 'class'=>'button orange-gradient full-width')); ?></li>
				</ul>

			<?php echo CHtml::endForm(); ?>
			<?php endif; ?>
	   </div>
     </div>
    </div>
    </div>