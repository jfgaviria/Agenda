<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="author" content="DSoto Creative Group S.A.S. - www.dsotogroup.com" />
    <meta name="description" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
    <meta name="keywords" content="<?php echo CHtml::encode($this->pageTitle); ?>" />
    <meta name="application-name" content="<?php echo CHtml::encode($this->pageTitle); ?>" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Le styles -->
    <?php if(!Yii::app()->user->isGuest): ?>
    <!-- Use new way for google web fonts 
    http://www.smashingmagazine.com/2012/07/11/avoiding-faux-weights-styles-google-web-fonts -->
    <!-- Headings -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css' />  -->
    <!-- Text -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css' /> --> 
    <!--[if lt IE 9]>
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->
    <?php endif; ?>
    
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/icons.css" rel="stylesheet" type="text/css" />
    <!-- Plugin stylesheets -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/uniform/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/ibutton/jquery.ibutton.css" type="text/css" rel="stylesheet" />
    <?php if(!Yii::app()->user->isGuest): ?>
    	<link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jpages/jPages.css" rel="stylesheet" type="text/css" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/prettify/prettify.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/inputlimiter/jquery.inputlimiter.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/color-picker/color-picker.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select/select2.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/validate/validate.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/pnotify/jquery.pnotify.default.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/pretty-photo/prettyPhoto.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/smartWizzard/smart_wizard.css" type="text/css" rel="stylesheet" />
	    <!-- <link href="<?php //echo Yii::app()->request->baseUrl; ?>/plugins/dataTables/jquery.dataTables.css" type="text/css" rel="stylesheet" /> -->
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/elfinder/elfinder.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/plupload/jquery.ui.plupload/css/jquery.ui.plupload.css" type="text/css" rel="stylesheet" />
	    <link href="<?php echo Yii::app()->request->baseUrl; ?>/plugins/search/tipuesearch.css" type="text/css" rel="stylesheet" />
    <?php endif; ?>

    <!-- Main stylesheets -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" rel="stylesheet" type="text/css" /> 
    <?php if(Yii::app()->user->isGuest): ?>
    	<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/colors.css" rel="stylesheet" type="text/css" />
    <?php else: ?>
    	<!-- Right to left version 
    	<link href="css/rtl.css" rel="stylesheet" type="text/css" /> -->
    <?php endif; ?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?php echo Yii::app()->request->baseUrl; ?>/images/apple-touch-icon-57-precomposed.png" />

    <?php if(!Yii::app()->user->isGuest): ?>
	    <script type="text/javascript">
	        //adding load class to body and hide page
	        document.documentElement.className += 'loadstate';
	    </script>
    <?php endif;?>
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    
    </head>
      
<?php if(Yii::app()->user->isGuest): ?>
	<body class="loginPage">
		<?php require_once 'protected/views/site/login.php'; ?>
<?php else: ?>
	<body>
	<!-- loading animation -->
    <div id="qLoverlay"></div>
    <div id="qLbar"></div>
    
    <!-- Header -->
    <?php require_once 'header.php'; ?>
    <!-- Fin Header -->
    
    <div id="wrapper">
    
    	<!--Responsive navigation button-->  
        <div class="resBtn">
            <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
        </div>
        
        <!--Left Sidebar collapse button-->  
        <div class="collapseBtn leftbar">
             <a href="#" class="tipR" title="Ocultar el Menu"><span class="icon12 minia-icon-layout"></span></a>
        </div>
        
        <!-- Sidebar -->
	    <?php require_once 'sidebar.php'; ?>
	    <!-- Fin Sidebar -->
	    
	    <!-- Body -->
	    <?php require_once 'body.php'; ?>
	    <!-- Fin Body -->

    </div>

<?php endif; ?>

	<!-- Le javascript
    ================================================== -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/touch-punch/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/ios-fix/ios-orientationchange-fix.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/uniform/jquery.uniform.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/ibutton/jquery.ibutton.min.js"></script>

	<?php if(!Yii::app()->user->isGuest): ?>	
		<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.cookie.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.mousewheel.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.populate.pack.js"></script>
	
	    <!-- Load plugins -->
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/qtip/jquery.qtip.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.grow.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.pie.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.resize.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.tooltip_0.4.4.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/flot/jquery.flot.orderBars.js"></script>
	
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/sparkline/jquery.sparkline.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/knob/jquery.knob.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/fullcalendar/fullcalendar.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/prettify/prettify.js"></script>
	
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/watermark/jquery.watermark.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/elastic/jquery.elastic.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/inputlimiter/jquery.inputlimiter.1.3.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/maskedinput/jquery.maskedinput-1.3.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/stepper/ui.stepper.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/color-picker/colorpicker.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/timeentry/jquery.timeentry.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/select/select2.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/dualselect/jquery.dualListBox-1.3.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/tiny_mce/jquery.tinymce.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/search/tipuesearch_set.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/search/tipuesearch_data.js"></script><!-- JSON for searched results -->
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/search/tipuesearch.js"></script>
	
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/animated-progress-bar/jquery.progressbar.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/pnotify/jquery.pnotify.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/lazy-load/jquery.lazyload.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jpages/jPages.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/pretty-photo/jquery.prettyPhoto.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/smartWizzard/jquery.smartWizard-2.0.min.js"></script>
	
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/dataTables/jquery.dataTables.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/elfinder/elfinder.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/plupload/plupload.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/plupload/plupload.html4.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/plupload/jquery.plupload.queue/jquery.plupload.queue.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/totop/jquery.ui.totop.min.js"></script> 
	
	    <!-- Init plugins -->
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/statistic.js"></script><!-- Control graphs ( chart, pies and etc) -->
	
	    <!-- Important Place before main.js  -->
	    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js"></script>
	    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
	<?php endif; ?>
    
	</body>
</html>