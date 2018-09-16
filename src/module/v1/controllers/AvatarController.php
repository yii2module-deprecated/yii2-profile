<?php

namespace yii2module\profile\module\v1\controllers;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\v2\forms\AvatarForm;
use yii2lab\navigation\domain\widgets\Alert;
use Yii;

/**
 * @property \yii2module\profile\module\v1\Module $module
 */
class AvatarController extends BaseController {

	public function actionIndex() {
		\App::$domain->navigation->breadcrumbs->create([$this->module->moduleLangId(), 'title']);
		$model = new AvatarForm();
		if(Yii::$app->request->isPost) {
			if(Yii::$app->request->post('submit')==='delete') {
				\App::$domain->profile->avatar->deleteSelf();
				\App::$domain->navigation->alert->create(['profile/avatar', 'delete_success'], Alert::TYPE_SUCCESS);
			} else {
				if($model->validate()) {
					try{
						\App::$domain->profile->avatar->updateSelf($model->imageFile);
						\App::$domain->navigation->alert->create(['profile/avatar', 'uploaded_success'], Alert::TYPE_SUCCESS);
					} catch (UnprocessableEntityHttpException $e){
						$model->addErrorsFromException($e);
					}
				}
			}
		}
		return $this->render('update', [
			'model' => $model,
			'avatar' => \App::$domain->profile->avatar->getSelf(),
		]);
	}
	
}