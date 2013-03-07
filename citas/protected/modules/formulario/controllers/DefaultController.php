<?php

class DefaultController extends Controller
{

	public function actionIndex()
	{
		$this->redirect(Yii::app()->getModule('user')->loginUrl);
	}
		
}