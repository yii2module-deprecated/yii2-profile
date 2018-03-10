<?php

namespace yii2module\profile\module\v1\controllers;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\v2\entities\PersonEntity;
use yii2module\profile\module\v1\forms\PersonForm;
use yii2lab\notify\domain\widgets\Alert;
use Yii;

class PersonController extends BaseController {

	public function actionIndex() {
		$model = new PersonForm();
		$body = Yii::$app->request->post('ProfileForm');
		if($body) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try{
					Yii::$app->profile->person->updateSelf($model);
					Yii::$app->navigation->alert->create(['profile/person', 'saved_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			/** @var PersonEntity $entity */
			$entity = Yii::$app->profile->person->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		
		return $this->render('index', [
			'modelMain' => $model,
		]);
	}
	
}