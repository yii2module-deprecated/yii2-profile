<?php

namespace yii2module\profile\api\v2\controllers;

use yii2lab\extension\web\helpers\Behavior;
use yii2lab\rest\domain\rest\Controller;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use Yii;
use yii2module\profile\domain\v2\forms\AvatarForm;
use yii2module\profile\domain\v2\interfaces\services\AvatarInterface;

/**
 * Class AvatarController
 *
 * @package yii2module\profile\api\v2\controllers
 *
 * @property-read AvatarInterface $service
 */
class AvatarController extends Controller {
	
	public $service = 'profile.avatar';
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'authenticator' => Behavior::auth(),
			'verb' => Behavior::verb([
				'view' => ['GET'],
				'update' => ['POST'],
				'delete' => ['DELETE'],
			]),
		];
	}
	
	public function actionView() {
		return $this->service->getSelf();
	}
	
	public function actionDelete() {
		$this->service->deleteSelf();
		Yii::$app->response->setStatusCode(204);
	}
	
	public function actionUpdate() {
		$model = new AvatarForm();
		if(!$model->validate()) {
			return $model;
		}
		try {
			$this->service->updateSelf($model->imageFile);
			Yii::$app->response->setStatusCode(201);
		} catch(UnprocessableEntityHttpException $e) {
			return $e->getErrors();
		}
	}
	
}