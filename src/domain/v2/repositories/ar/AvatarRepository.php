<?php

namespace yii2module\profile\domain\v2\repositories\ar;

use yii\web\NotFoundHttpException;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\data\Query;
use yii2lab\domain\repositories\ActiveArRepository;
use Yii;
use yii\db\ActiveRecord;
use yii2module\profile\domain\v2\entities\AvatarEntity;

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
			$entity = new AvatarEntity();
			$entity->id = $id;
			$this->insert($entity);
		}
		return $entity;
	}
	
	public function all(Query $query = null) {
		$query = Query::forge($query);
		$collection = parent::all($query);
		if(empty($collection)) {
			$ids = $query->getParam('where.id');
			$collection = [];
			foreach($ids as $id) {
				$entity = $this->forgeEntity(['id' => $id]);
				$this->insert($entity);
				$collection[] = $entity;
			}
		}
		return $collection;
	}
	
	public function insert(BaseEntity $entity) {
		$entity->validate();
		/** @var ActiveRecord $model */
		$model = Yii::createObject(get_class($this->model));
		$this->massAssignmentForInsert($model, $entity);
		$this->saveModel($model);
	}
	
	protected function massAssignmentForInsert(ActiveRecord $model, BaseEntity $entity) {
		$data = $entity->toArray();
		$data = $this->unsetNotExistedFields($model, $data);
		Yii::configure($model, $data);
	}
}
