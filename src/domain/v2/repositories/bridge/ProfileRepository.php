<?php

namespace yii2module\profile\domain\v2\repositories\bridge;

use Yii;
use yii2lab\domain\data\Query;
use yii2lab\domain\enums\RelationEnum;
use yii2lab\domain\helpers\repository\RelationHelper;
use yii2lab\domain\repositories\BaseRepository;
use yii2lab\domain\traits\ActiveRepositoryTrait;

class ProfileRepository extends BaseRepository {
	
	use ActiveRepositoryTrait;
	
	public function relations() {
		return [
			'address' => [
				'type' => RelationEnum::ONE,
				'field' => 'id',
				'foreign' => [
					'id' => 'profile.address',
					'field' => 'id',
				],
			],
			'avatar' => [
				'type' => RelationEnum::ONE,
				'field' => 'id',
				'foreign' => [
					'id' => 'profile.avatar',
					'field' => 'id',
				],
			],
			'person' => [
				'type' => RelationEnum::ONE,
				'field' => 'id',
				'foreign' => [
					'id' => 'profile.person',
					'field' => 'id',
				],
			],
		];
	}
	
	public function one(Query $query = null) {
		$query = Query::forge($query);
		$id = $query->getParam('where.id');
		$loginEntity = Yii::$app->account->login->oneById($id);
		$entity = $this->forgeEntity([
			'id' => $loginEntity->id,
		]);
		if(!empty($query->getParam('with'))) {
			$entity = RelationHelper::load($this->domain->id, $this->id, $query, $entity);
		}
		return $entity;
	}
}
