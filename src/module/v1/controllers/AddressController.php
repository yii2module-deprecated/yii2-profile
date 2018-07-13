<?php

namespace yii2module\profile\module\v1\controllers;

use yii2module\profile\domain\v2\entities\AddressEntity;
use yii2module\profile\module\v1\forms\AddressForm;
use Yii;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\navigation\domain\widgets\Alert;

/**
 * @property \yii2module\profile\module\v1\Module $module
 */
class AddressController extends BaseController {

    public function actionIndex() {
	    Yii::$domain->navigation->breadcrumbs->create([$this->module->moduleLangId(), 'title']);
		$model = new AddressForm();
		if(Yii::$app->request->post()) {
			$body = Yii::$app->request->post();
			$model->setAttributes($body['AddressForm'], false);
			try {
				Yii::$domain->profile->address->updateSelf($model);
				Yii::$domain->navigation->alert->create(['profile/address', 'saved_success'], Alert::TYPE_SUCCESS);
			} catch(UnprocessableEntityHttpException $e) {
				$model->addErrorsFromException($e);
			}
		} else {
			/** @var AddressEntity $entity */
			$entity = Yii::$domain->profile->address->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		return $this->render('update', [
			'model' => $model,
		]);
	}
	
}