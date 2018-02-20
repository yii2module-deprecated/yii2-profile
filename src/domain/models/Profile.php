<?php

namespace yii2module\profile\domain\models;

use yii\db\ActiveRecord;

class Profile extends ActiveRecord
{

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_profile}}';
	}
	
}
