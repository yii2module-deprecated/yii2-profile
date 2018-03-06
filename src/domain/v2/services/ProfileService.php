<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii2lab\domain\data\Query;
use yii2lab\domain\services\ActiveBaseService;

class ProfileService extends ActiveBaseService {
	
	public function getSelf(Query $query = null) {
		$id = Yii::$app->user->identity->id;
		$profile = $this->repository->oneById($id, $query);
		return $profile;
	}
	
}
