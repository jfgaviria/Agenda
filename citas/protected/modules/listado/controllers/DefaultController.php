<?php

class DefaultController extends Controller
{
	public function init(){
		ListadoModule::setThis($this);
	}
	
	public function actionIndex()
	{
		$this->render('index');
	}
}