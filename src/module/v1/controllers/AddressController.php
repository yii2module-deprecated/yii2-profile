<?php

namespace yii2module\profile\module\v1\controllers;

use yii2module\profile\domain\v1\entities\AddressEntity;
use yii2module\profile\module\v1\forms\AddressForm;
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
				Yii::$app->navigation->alert->create(['profile/profile', 'saved_success'], Alert::TYPE_SUCCESS);
			} catch(UnprocessableEntityHttpException $e) {
				$model->addErrorsFromException($e);
			}
		} else {
			/** @var AddressEntity $entity */
			$entity = Yii::$app->profile->address->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $this->render('address', [
			'model' => $model,
		]);
	}
	
}