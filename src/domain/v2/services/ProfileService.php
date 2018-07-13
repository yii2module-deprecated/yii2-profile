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
		$query = Query::forge($query);
		$with = $query->getParam('with');
		$profileEntity = new ProfileEntity();
		$profileEntity->id = $id;
		$profileEntity = $this->loadRelations($profileEntity, $with);
		return $profileEntity;
	}
	
	private function loadRelations(ProfileEntity $profileEntity, $with) {
		if(empty($with)) {
			return $profileEntity;
		}
		foreach($with as $item) {
			$this->loadRelation($profileEntity, $item);
		}
		return $profileEntity;
	}
	
	private function loadRelation(ProfileEntity $profileEntity, $with) {
		$this->validateRelationName($with);
		$serviceName = $this->domain->id . DOT . $with;
		if(! ServiceHelper::has($serviceName)) {
			throw new BadRequestHttpException('Service "' . $with . '" not found');
		}
		$profileEntity->{$with} = ServiceHelper::oneById($serviceName, $profileEntity->id);
	}
	
	private function validateRelationName($name) {
		if(preg_match('#[^a-z]+#i', $name)) {
			throw new BadRequestHttpException('Bad name for relation "' . $name . '"');
		}
	}
	
}
