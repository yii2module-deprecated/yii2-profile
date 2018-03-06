<?php

namespace yii2module\profile\domain\v1\forms;

use yii2lab\domain\base\Model;
use domain\v4\active\entities\ProviderEntity;
use paulzi\jsonBehavior\JsonValidator;

class ActiveForm extends Model{
	
	public $id;
	public $user_id;
	public $active_id;
	public $provider_id;
	public $currency_code;
	public $amount = 0;
	public $data;
	public $provider;
	public $type;
	
	public function fieldType() {
		return [
			'provider' => [
				'type' => ProviderEntity::class,
			],
		];
	}
	public function rules() {
		return [
			[['active_id', 'data', 'provider_id', 'currency_code'], 'required'],
			[['active_id', 'provider_id', 'currency_code'], 'integer'],
			[['data'], JsonValidator::class],
		];
	}
}