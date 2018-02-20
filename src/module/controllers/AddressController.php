<?php

namespace yii2module\profile\module\controllers;

use yii2module\profile\module\forms\AddressForm;
use Yii;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\notify\domain\widgets\Alert;

class AddressController extends BaseController {

    public function actionIndex() {
		$model = new AddressForm();
		if(Yii::$app->request->post()) {
			$body = Yii::$app->request->post();
			$model->setAttributes($body['AddressForm'], false);
			try {
				Yii::$app->profile->address->updateSelf($model);
				Yii::$app->notify->flash->send(['profile/profile', 'saved_success'], Alert::TYPE_SUCCESS);
			} catch(UnprocessableEntityHttpException $e) {
				$model->addErrorsFromException($e);
			}
		} else {
			$entity = Yii::$app->profile->address->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $this->render('address', [
			'model' => $model,
		]);
	}
	
}