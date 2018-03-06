<?php

namespace yii2module\profile\domain\v1\models;

use yii\db\ActiveRecord;

/**
 * Confirm model
 *
 * @property string $login
 * @property string $action
 * @property string $activation_code
 * @property string $created_at
 */
class Address extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_address}}';
	}
	
}
