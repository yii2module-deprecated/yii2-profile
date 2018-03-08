<?php

namespace yii2module\profile\domain\v2\repositories\ar;

use yii\web\NotFoundHttpException;
use yii2lab\domain\data\Query;
use yii2lab\domain\repositories\ActiveArRepository;

class AvatarRepository extends ActiveArRepository {
	
	public $defaultName = 'default';
	
	public function tableName()
	{
		return 'profile_avatar';
	}
	
	public function one(Query $query = null) {
		$query = Query::forge($query);
		try {
			$entity = parent::one($query);
		} catch(NotFoundHttpException $e) {
			$id = $query->getParam('where.id');
			$this->insertRecord($id);
			$entity = parent::one($query);
		}
		return $entity;
	}
	
	// todo: сделать так же в address и person
	
	public function all(Query $query = null) {
		$query = Query::forge($query);
		$collection = parent::all($query);
		if(empty($collection)) {
			$ids = $query->getParam('where.id');
			foreach($ids as $id) {
				$this->insertRecord($id);
			}
			$collection = parent::all($query);
		}
		return $collection;
	}
	
	private function insertRecord($id) {
		$entity = $this->forgeEntity(['id' => $id]);
		$this->insert($entity);
		return $entity;
	}
}
