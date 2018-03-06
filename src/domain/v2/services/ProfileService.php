<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii2lab\domain\data\Query;
use yii2lab\domain\services\ActiveBaseService;
use yii2module\profile\domain\v2\entities\ProfileEntity;

class ProfileService extends ActiveBaseService {
	
	public function getSelf(Query $query = null) {
		/** @var Query $query */
		/*$query = Query::forge($query);
		//prr($query->toArray());
		$login = Yii::$app->user->identity->login;
		$profile = new ProfileEntity();
		$profile->login = $login;
		
		//$loginEntity = Yii::$app->account->login->oneByLogin($login);
		
		$profile->person = $this->domain->repositories->person->oneById($login, $query);*/
		
		$login = Yii::$app->user->identity->login;
		
		$profile = $this->repository->oneById($login, $query);
		
		return $profile;
	}
	
}
