<?php

namespace yii2module\profile\module\controllers;

use yii2lab\helpers\Behavior;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\forms\AvatarForm;
use yii2module\profile\module\forms\ProfileForm;
use yii2lab\notify\domain\widgets\Alert;
use Yii;
use yii\web\Controller;

class PersonController extends Controller {
	
	public function behaviors() {
		return [
			'access' => Behavior::access('@'),
		];
	}
	
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
					Yii::$app->profile->profile->updateSelf($model);
					Yii::$app->notify->flash->send(['profile/profile', 'saved_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			$entity = Yii::$app->profile->profile->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $model;
	}
	
	private function avatarForm() {
		$model = new AvatarForm();
		if(Yii::$app->request->isPost) {
			if(Yii::$app->request->post('submit')==='delete') {
				Yii::$app->profile->avatar->deleteSelf();
				Yii::$app->notify->flash->send(['profile/avatar', 'delete_success'], Alert::TYPE_SUCCESS);
			} else {
				if($model->validate()) {
					try{
						Yii::$app->profile->avatar->updateSelf($model->imageFile);
						Yii::$app->notify->flash->send(['profile/avatar', 'uploaded_success'], Alert::TYPE_SUCCESS);
					} catch (UnprocessableEntityHttpException $e){
						$model->addErrorsFromException($e);
					}
				}
			}
		}
		return $model;
	}
	
}