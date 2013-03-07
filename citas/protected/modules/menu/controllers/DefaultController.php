<?php

class DefaultController extends Controller
{
	public function init(){
		
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionMenuItems(){
		$menu_model = Menu::model()->findAll('status=:status', array(':status'=>1));
		$items = array();
		$cn = count($menu_model);
		
		if($cn > 0){
			foreach($menu_model AS $item){
				$tmp = array();
				$tmp['label'] = $item->title;
				if($item->subtitle != ''){
					if($item->subtitle_pos == 1){
						$tmp['label'] = $item->subtitle.$tmp['label'];
					}else if($item->subtitle_pos == 1){
						$tmp['label'] = $tmp['label'].$item->subtitle;
					}
				}
				$tmp['url'] = array($item->url);
				if(!is_null($item->active)){
					$tmp['active'] = $item->active;
				}
				if(!is_null($item->visible)){
					$tmp['visible'] = $item->visible;
				}
				
				$items[] = $tmp;
			}
			MenuModule::renderMenu($this, $items);
		}else{
			echo 'Sin Items';	
		}
	}
}