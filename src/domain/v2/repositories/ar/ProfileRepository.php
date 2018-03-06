<?php

namespace yii2module\profile\domain\v2\repositories\ar;

use Yii;
use yii2lab\domain\data\Query;
use yii2lab\domain\enums\RelationEnum;
use yii2lab\domain\helpers\repository\RelationHelper;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\domain\traits\ActiveRepositoryTrait;

class ProfileRepository extends BaseRepository {
	
	use ActiveRepositoryTrait;
	
	protected $primaryKey = 'login';
	
	public function relations() {
		return [
			'address' => [
				'type' => RelationEnum::ONE,
				'field' => 'login',
				'foreign' => [
					'id' => 'profile.address',
					'field' => 'login',
				],
			],
			/*'avatar' => [
				'type' => RelationEnum::ONE,
				'field' => 'login',
				'foreign' => [
					'id' => 'profile.avatar',
					'field' => 'login',
				],
			],*/
			'person' => [
				'type' => RelationEnum::ONE,
				'field' => 'login',
				'foreign' => [
					'id' => 'profile.person',
					'field' => 'login',
				],
			],
		];
	}
	
	public function one(Query $query = null) {
		$query = Query::forge($query);
		$login = $query->getParam('where.login');
		$loginEntity = Yii::$app->account->login->oneByLogin($login);
		$entity = $this->forgeEntity([
			'id' => $loginEntity->id,
			'login' => $loginEntity->login,
		]);
		if(!empty($query->getParam('with'))) {
			$entity = RelationHelper::load($this->domain->id, $this->id, $query, $entity);
		}
		return $entity;
	}
}
