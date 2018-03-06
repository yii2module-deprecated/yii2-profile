<?php

namespace yii2module\profile\domain\v2\models;

use domain\v4\active\models\Provider;
use domain\v4\active\models\Type;
use paulzi\jsonBehavior\JsonBehavior;
use yii\db\ActiveRecord;

class Active extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_active}}';
	}
	
	public function behaviors()
	{
		return [
			[
				'class' => JsonBehavior::class,
				'attributes' => ['data'],
			],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return ['active_type', 'provider'];
	}
	
	public function fields()
	{
		$fields = parent::fields();
		$fields['type']= 'type';
		$fields['provider']= 'provider';
		return $fields;
	}
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getType()
	{
		return $this->hasOne(Type::class, [
			'id' => 'active_id',
		]);
	}
	
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvider()
	{
		return $this->hasOne(Provider::class, [
			'id' => 'provider_id',
		]);
	}
	
}
