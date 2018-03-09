<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii\web\BadRequestHttpException;
use yii2lab\domain\data\Query;
use yii2lab\domain\helpers\ServiceHelper;
use yii2lab\domain\services\ActiveBaseService;
use yii2module\profile\domain\v2\entities\ProfileEntity;

class ProfileService extends ActiveBaseService {
	
	public function getSelf(Query $query = null) {
		$id = Yii::$app->user->identity->id;
		$profile = $this->oneById($id, $query);
		return $profile;
	}
	
	public function oneById($id, Query $query = null) {
		$with = $query->getParam('with');
		$profileEntity = new ProfileEntity();
		foreach($with as $item) {
			if(preg_match('#[^a-z]+#i', $item)) {
				throw new BadRequestHttpException('Bad name for relation "' . $item . '"');
			}
			$serviceName = $this->domain->id . DOT . $item;
			if(! ServiceHelper::has($serviceName)) {
				throw new BadRequestHttpException('Service "' . $item . '" not found');
			}
			$profileEntity->{$item} = ServiceHelper::oneById($serviceName, $id);
		}
		return $profileEntity;
	}
	
}
