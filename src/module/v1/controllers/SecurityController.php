<?php

namespace yii2module\profile\module\v1\controllers;

use yii2module\account\module\forms\ChangePasswordForm;
use Yii;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\notify\domain\widgets\Alert;
use yii2module\account\domain\v1\forms\ChangeEmailForm;

class SecurityController extends BaseController {

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
					Yii::$app->navigation->alert->create(['profile/security', 'email_changed_success'], Alert::TYPE_SUCCESS);
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
					Yii::$app->navigation->alert->create(['profile/security', 'password_changed_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e) {
					$model->addErrorsFromException($e);
				}
			}
		}
		return $model;
	}
	
}