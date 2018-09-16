<?php

namespace yii2module\profile\domain\v1\services;

use yii2lab\domain\data\Query;
use yii2lab\domain\services\ActiveBaseService;
use Yii;
use yii\helpers\ArrayHelper;

class ActiveService extends ActiveBaseService {
	
	// todo: обновлять значения json-данных при удалении или обновлении филдов
	
	public $userAccessOnly = true;
	public $foreignServices = [
		'active.type' => [
			'field' => 'active_id',
			'notFoundMessage' => ['active/type', 'not_found'],
		],
		'active.provider' => [
			'field' => 'provider_id',
			'notFoundMessage' => ['active/provider', 'not_found'],
		],
		'active.currency' => [
			'field' => 'currency_id',
			'notFoundMessage' => ['geo/currency', 'not_found'],
		],
	];
	
	public function createData($data) {
		$data = ArrayHelper::toArray($data);
		$data['data'] = Yii::$app->active->field->validate($data['active_id'], $data['data']);
		parent::create($data);
	}
	
	public function updateDataById($id, $data) {
		$this->beforeAction(__FUNCTION__);
		$data = ArrayHelper::toArray($data);
		$entity = $this->oneById($id);
		$entity->load($data);
		$entity->validate();
		unset($data['active_id']);
		unset($data['amount']);
		$this->validateForeign($data);
		$this->validateForbiddenChangeFields($data);
		
		$data['data'] = Yii::$app->active->field->validate($entity->active_id, $data['data']);
		
		$this->addUserId($entity);
		$this->repository->update($entity);
		return $this->afterAction(__FUNCTION__, null);
	}
	
	public function updateAmountById($id, $amount) {
		$this->beforeAction(__FUNCTION__);
		$data['amount'] = $amount;
		$entity = $this->oneById($id);
		$entity->load($data);
		$entity->validate();
		$this->repository->update($entity);
		return $this->afterAction(__FUNCTION__, null);
	}
	public function updateTitleById($id, $title) {
		$this->beforeAction(__FUNCTION__);
		$entity = $this->oneById($id);
		$entity->data['title'] = $title;
		$entity->load($entity);
		$entity->validate();
		$this->repository->update($entity);
		return $this->afterAction(__FUNCTION__, null);
	}
	public function allWithProvider(Query $query = null) {
		$query = Query::forge($query);
		$query->with('provider');
		$actives = \App::$domain->profile->active->all($query);
		return $actives;
	}
	
}
