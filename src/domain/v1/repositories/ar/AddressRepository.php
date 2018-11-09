<?php

namespace yii2module\profile\domain\v1\repositories\ar;

use yii\db\BaseActiveRecord;
use yii2lab\domain\BaseEntity;
use yii2lab\domain\repositories\ActiveArRepository;
use Yii;
use yii\db\ActiveRecord;

class AddressRepository extends ActiveArRepository {
	
	protected $primaryKey = 'login';
	
	public function insert(BaseEntity $entity) {
		$entity->validate();
		$model = Yii::createObject(get_class($this->model));
		$this->massAssignmentForInsert($model, $entity);
		$this->saveModel($model);
	}
	
	protected function massAssignmentForInsert(BaseActiveRecord $model, BaseEntity $entity) {
		$data = $entity->toArray();
		$data = $this->unsetNotExistedFields($model, $data);
		Yii::configure($model, $data);
	}
}
