<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii2lab\domain\services\ActiveBaseService;
use yii\web\NotFoundHttpException;

class CarService extends ActiveBaseService {
	
	public function getSelf() {
		$id = Yii::$app->user->identity->id;
		try {
			$profile = $this->oneById($id);
		} catch (NotFoundHttpException $e) {
			$this->create(['id' => $id]);
			$profile = $this->oneById($id);
		}
		return $profile;
	}
	
	public function updateSelf($body) {
		$profile = $this->getSelf();
		$this->updateById($profile->id, $body);
	}
	
}
