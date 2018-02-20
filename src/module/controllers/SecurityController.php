<?php

namespace yii2module\profile\module\controllers;

use yii2lab\helpers\Behavior;
use yii2module\account\module\forms\ChangePasswordForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\account\domain\forms\ChangeEmailForm;

class SecurityController extends Controller {
	
	public function behaviors() {
		return [
			'access' => Behavior::access('@'),
		];
	}
	
	public function actionIndex() {
		return $this->render('security', [
			'modelPassword' => $this->passwordForm(),
			'modelEmail' => $this->emailForm(),
		]);
	}
	
	private function emailForm() {
		$model = new ChangeEmailForm();
		$body = Yii::$app->request->post('ChangeEmailForm');
		if (!empty($body)) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try {
					Yii::$app->account->security->changeEmail($model->getAttributes());
					Yii::$app->notify->flash->send(['profile/profile', 'email_changed_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e) {
					$model->addErrorsFromException($e);
				}
			}
		} else {
			$model->email = Yii::$app->account->auth->identity->email;
		}
		return $model;
	}
	
	private function passwordForm() {
		$model = new ChangePasswordForm();
		$body = Yii::$app->request->post('ChangePasswordForm');
		if(!empty($body)) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				$bodyPassword = $model->getAttributes(['password', 'new_password']);
				try {
					Yii::$app->account->security->changePassword($bodyPassword);
					Yii::$app->notify->flash->send(['profile/profile', 'password_changed_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e) {
					$model->addErrorsFromException($e);
				}
			}
		}
		return $model;
	}
	
}