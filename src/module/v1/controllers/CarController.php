<?php

namespace yii2module\profile\module\v1\controllers;

use yii2module\profile\module\v1\forms\CarForm;
use Yii;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\notify\domain\widgets\Alert;

class CarController extends BaseController {

	public function actionIndex() {
		$model = new CarForm();
		$body = Yii::$app->request->post('CarForm');
		if($body) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try{
					Yii::$app->profile->car->updateSelf($model);
					Yii::$app->navigation->alert->create(['account/car', 'saved_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			$entity = Yii::$app->profile->car->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $this->render('car', ['model' => $model]);
	}
	
}