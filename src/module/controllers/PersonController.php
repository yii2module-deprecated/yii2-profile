<?php

namespace yii2module\profile\module\controllers;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\v1\forms\AvatarForm;
use yii2module\profile\module\forms\ProfileForm;
use yii2lab\notify\domain\widgets\Alert;
use Yii;

class PersonController extends BaseController {

	public function actionIndex() {
		return $this->render('index', [
			'modelMain' => $this->mainForm(),
			'modelAvatar' => $this->avatarForm(),
			'avatar' => Yii::$app->profile->avatar->getSelf(),
		]);
	}
	
	private function mainForm() {
		$model = new ProfileForm();
		$body = Yii::$app->request->post('ProfileForm');
		if($body) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try{
					Yii::$app->profile->person->updateSelf($model);
					Yii::$app->navigation->alert->create(['profile/profile', 'saved_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			$entity = Yii::$app->profile->person->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $model;
	}
	
	private function avatarForm() {
		$model = new AvatarForm();
		if(Yii::$app->request->isPost) {
			if(Yii::$app->request->post('submit')==='delete') {
				Yii::$app->profile->avatar->deleteSelf();
				Yii::$app->navigation->alert->create(['profile/avatar', 'delete_success'], Alert::TYPE_SUCCESS);
			} else {
				if($model->validate()) {
					try{
						Yii::$app->profile->avatar->updateSelf($model->imageFile);
						Yii::$app->navigation->alert->create(['profile/avatar', 'uploaded_success'], Alert::TYPE_SUCCESS);
					} catch (UnprocessableEntityHttpException $e){
						$model->addErrorsFromException($e);
					}
				}
			}
		}
		return $model;
	}
	
}