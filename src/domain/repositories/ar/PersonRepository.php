<?php

namespace yii2module\profile\domain\repositories\ar;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\repositories\ActiveArRepository;
use Yii;
use yii\db\ActiveRecord;

class PersonRepository extends ActiveArRepository {
	
	protected $primaryKey = 'login';
	
	public function insert(BaseEntity $entity) {
		$entity->validate();
		$model = Yii::createObject($this->model->className());
		$this->massAssignmentForInsert($model, $entity);
		$this->saveModel($model);
	}
	
	protected function massAssignmentForInsert(ActiveRecord $model, BaseEntity $entity) {
		$data = $entity->toArray();
		$data = $this->unsetNotExistedFields($model, $data);
		Yii::configure($model, $data);
	}
}
