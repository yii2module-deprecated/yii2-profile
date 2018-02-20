<?php

namespace yii2module\profile\domain\entities;

use yii2lab\domain\BaseEntity;

class CarEntity extends BaseEntity {
	
	protected $login;
	protected $gov_number;
	protected $document_number;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['gov_number', 'document_number'], 'trim'],
			['gov_number', 'string', 'max' => 10],
			['document_number', 'string', 'max' => 16],
		];
	}
	
}
