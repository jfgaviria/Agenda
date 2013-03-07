<?php

class MenuModule extends CWebModule
{
	static private $_this = null;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'menu.models.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	public static function renderMenu($this, $menuItems, $menuOptions = array()){
		self::$_this = $this;
		
		if(count($menuOptions) > 0){
			$id 				= isset($menuOptions['id']) ? $menuOptions['id'] : 'menu-ppal';
			$itemCssClass 		= isset($menuOptions['itemCssClass']) ? $menuOptions['itemCssClass'] : '';
			$activeCssClass 	= isset($menuOptions['activeCssClass']) ? $menuOptions['activeCssClass'] : '';
			$submenuHtmlOptions = isset($menuOptions['submenuHtmlOptions']) ? $menuOptions['submenuHtmlOptions'] : array();
			$lastItemCssClass 	= isset($menuOptions['lastItemCssClass']) ? $menuOptions['lastItemCssClass'] : '';
			$linkLabelWrapper 	= isset($menuOptions['linkLabelWrapper']) ? $menuOptions['linkLabelWrapper'] : null;
			$encodeLabel 		= isset($menuOptions['encodeLabel']) ? $menuOptions['encodeLabel'] : false;
		}else{
			$id 				= 'menu-ppal';
			$itemCssClass 		= '';
			$activeCssClass 	= '';
			$submenuHtmlOptions = array();
			$lastItemCssClass 	= '';
			$linkLabelWrapper 	= null;
			$encodeLabel 		= false;
		}
		
		self::$_this->widget('zii.widgets.CMenu',array(
				'id'=>$id,
				'itemCssClass'=>$itemCssClass,
				'activeCssClass'=>$activeCssClass,
				'submenuHtmlOptions'=>$submenuHtmlOptions,
				'lastItemCssClass'=>$lastItemCssClass,
				'linkLabelWrapper'=>$linkLabelWrapper,
				'encodeLabel'=>$encodeLabel,
				'items'=>$menuItems,
		));
	}

}
