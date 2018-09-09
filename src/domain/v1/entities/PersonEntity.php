<?php

namespace yii2module\profile\domain\v1\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\values\TimeValue;
use yii2lab\extension\enum\enums\TimeEnum;
use yii2lab\validator\IinValidator;
use Yii;
use yii\validators\DateValidator;

class PersonEntity extends BaseEntity {
	
	protected $login;
	protected $first_name;
	protected $last_name;
	protected $iin;
	protected $birth_date;
	protected $sex;

	public function fieldType() {
		return [
			'iin' => 'string',
			'birth_date' => TimeValue::class,
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$maxBirthDate = time() - TimeEnum::SECOND_PER_DAY;
		return [
			[['first_name', 'last_name', 'iin', 'birth_date'], 'trim'],
			[
				'birth_date',
				DateValidator::class,
				'type' => DateValidator::TYPE_DATE,
				'format' => 'yyyy-MM-dd',
				'max' => date('Y-m-d', $maxBirthDate)
			],
			[['sex'], 'boolean'],
			['iin', IinValidator::class],
		];
	}
	
}
