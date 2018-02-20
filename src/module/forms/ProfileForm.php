<?php

namespace yii2module\profile\module\forms;

use Yii;
use yii2lab\domain\base\Model;

class ProfileForm extends Model
{
	
	public $first_name;
	public $last_name;
	public $iin;
	public $birth_date;
	public $sex;


	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
			'first_name' => Yii::t('profile/profile', 'first_name'),
			'last_name' => Yii::t('profile/profile', 'last_name'),
			'iin' => Yii::t('profile/profile', 'iin'),
			'birth_date' => Yii::t('profile/profile', 'birth_date'),
			'sex' => Yii::t('profile/profile', 'sex'),
		];
	}
	
}
