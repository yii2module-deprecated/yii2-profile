<?php

namespace yii2module\profile\module\v1\controllers;

use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2module\profile\domain\v2\forms\AvatarForm;
use yii2lab\notify\domain\widgets\Alert;
use Yii;

class AvatarController extends BaseController {

	public function actionIndex() {
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
		return $this->render('update', [
			'model' => $model,
			'avatar' => Yii::$app->profile->avatar->getSelf(),
		]);
	}
	
}