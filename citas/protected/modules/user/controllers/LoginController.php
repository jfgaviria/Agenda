<?php

class LoginController extends Controller
{
	public $defaultAction = 'login';

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$_POST['UserLogin'] = $_POST['UserLogin'][0];
				$model->attributes 	= $_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl=='/index.php' || Yii::app()->user->returnUrl=='/index.php/user/login'){
						echo json_encode(array('logged'=>CController::createUrl('/'.Yii::app()->controller->module->returnUrl)));
						Yii::app()->end();
					}else{
						echo json_encode(array('logged'=>CController::createUrl('/'.Yii::app()->controller->module->returnUrl[0])));
						Yii::app()->end();
					}
				}else{
					echo json_encode(array('error'=>CHtml::errorSummary($model,'')));
					Yii::app()->end();
				}
			}
			// display the login form
			$this->render('/user/login',array('model'=>$model));
		} else
			$this->redirect(Yii::app()->controller->module->returnUrl);
	}
	
	private function lastViset() {
		$lastVisit = User::model()->notsafe()->findByPk(Yii::app()->user->id);
		$lastVisit->lastvisit = time();
		$lastVisit->save();
	}

}