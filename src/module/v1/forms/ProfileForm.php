<?php

namespace yii2module\profile\module\v1\forms;

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
			'first_name' => Yii::t('profile/person', 'first_name'),
			'last_name' => Yii::t('profile/person', 'last_name'),
			'iin' => Yii::t('profile/person', 'iin'),
			'birth_date' => Yii::t('profile/person', 'birth_date'),
			'sex' => Yii::t('profile/person', 'sex'),
		];
	}
	
}
