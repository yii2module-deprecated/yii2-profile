<?php

namespace yii2module\profile\domain\v2\models;

use yii\db\ActiveRecord;

class Person extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_profile}}';
	}
	
}
