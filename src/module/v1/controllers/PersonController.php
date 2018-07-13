<?php

namespace yii2module\profile\module\v1\controllers;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\v2\entities\PersonEntity;
use yii2module\profile\module\v1\forms\PersonForm;
use yii2lab\navigation\domain\widgets\Alert;
use Yii;

/**
 * @property \yii2module\profile\module\v1\Module $module
 */
class PersonController extends BaseController {

	public function actionIndex() {
		Yii::$domain->navigation->breadcrumbs->create([$this->module->moduleLangId(), 'title']);
		$model = new PersonForm();
		$body = Yii::$app->request->post('PersonForm');
		if($body) {
			$model->setAttributes($body, false);
			if($model->validate()) {
				try{
					Yii::$domain->profile->person->updateSelf($model);
					Yii::$domain->navigation->alert->create(['profile/person', 'saved_success'], Alert::TYPE_SUCCESS);
				} catch (UnprocessableEntityHttpException $e){
					$model->addErrorsFromException($e);
				}
			}
		} else {
			/** @var PersonEntity $entity */
			$entity = Yii::$domain->profile->person->getSelf();
			$model->setAttributes($entity->toArray(), false);
		}
		
		return $this->render('update', [
			'modelMain' => $model,
		]);
	}
	
}