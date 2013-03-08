<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

date_default_timezone_set('America/Bogota');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Agenda Médica',
	'language'=>'es',
	'charset'=>'utf-8',
	'defaultController' => 'Escritorio',
 
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.formulario.*',
		'application.modules.listado.*',
		'application.modules.menu.*',
// 		'application.modules.menu.models.*',
// 		'application.modules.Geocoder.*',
		'application.modules.user.models.*',
		'application.modules.user.components.*',
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		'application.extensions.EDataTables.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'3.x/dos',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user'=>array(
			'tableUsers' => 'cpt_users',
			'tableProfiles' => 'cpt_profiles',
			'tableProfileFields' => 'cpt_profiles_fields',
			'hash' => 'md5',
			'sendActivationMail' => true,
			'loginNotActiv' => false, 							//Permitir el acceso a los usuarios no activados
			'activeAfterRegister' => false,						//Debe ser el valor contrario a sendActivationEmail
			'autoLogin' => true,
			'registrationUrl' => array('/user/registration'),
			'recoveryUrl' => array('/user/recovery'),
			'loginUrl' => array('/user/login'),
			'returnUrl' => array('escritorio'),				//Pagina a redireccionar despues del logeo
			'returnLogoutUrl' => array('/user/login'),			//Pagina a redireccionar despues de salir
			'rememberMeTime' => 7200,							//Tiempo de vida de la sesion
			
		),
		'rights'=>array(
			'superuserName'=>'Admin',
			'authenticatedName'=>'Authenticated',
			'userIdColumn'=>'id',
			'userNameColumn'=>'username',
			'enableBizRule'=>true,
			'enableBizRuleData'=>true,
			'displayDescription'=>true,
			'flashSuccessKey'=>'RightsSuccess',
			'flashErrorKey'=>'RightsError',
			'baseUrl'=>'/rights',
			'layout'=>'rights.views.layouts.main',
			'appLayout'=>'application.views.layouts.main',
			'debug'=>false,
			'install' => false,
		),
		'formulario'=>array(
			'formCssClass'=>'form-horizontal',
			'formEnclosureRowTag'=>'div',
			'formEnclosureSubRowTag'=>'div',
			'formRowCssClass'=>'form-row row-fluid',
			'formSubRowCssClass'=>'span12',
			'formEnclosureFieldTag'=>'div',
			'formEnclosureFieldTagCssClass'=>'row-fluid',
			'formInfoInputCssClass'=>'',
			'formLabelCssClass'=>'form-label span3',
			'formInputCssClass'=>'span9',
			'formSelectCssClass'=>'span9 nostyle',
			'formSwitchCssClass'=>'switch',
			'formEnclosureRowButtonsTag'=>'div',
			'formRowButtonsCssClass'=>'form-actions',
			'formEnclosureSubRowButtonsTag'=>'div',
			'formSubRowButtonsCssClass'=>'span9 controls',
			'formSubmitCssClass'=>'btn btn-success nostyle span2',
			'formCancelCssClass'=>'btn btn-danger marginR10 nostyle span2',
			'formSubmitLabel'=>'Guardar',
			'formCancelLabel'=>'Cancelar',
		),
		'listado',
		'menu',
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'class' => 'RWebUser',
			'allowAutoLogin' => true,
			'loginUrl' => array('/user/login'),
		),
		'authManager'=>array(
			'class' => 'RDbAuthManager',
			'assignmentTable' => 'cpt_AuthAssignment',
			'itemTable' => 'cpt_AuthItem',
			'itemChildTable' => 'cpt_AuthItemChild',
			'rightsTable' => 'cpt_Rights',
			'connectionID'=>'db',
			'defaultRoles'=>array('Callcenter', 'Guest'),
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		// Base de Datos
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=agenda',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'cpt_',
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'/site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'jfgaviria@gmail.com',
		'pageSize'=>'25',
	),
);