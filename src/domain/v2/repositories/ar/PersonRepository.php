<?php

namespace yii2module\profile\domain\v2\repositories\ar;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\repositories\ActiveArRepository;
use Yii;
use yii\db\ActiveRecord;

class PersonRepository extends ActiveArRepository {
	
	public function tableName()
	{
		return 'profile_person';
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
