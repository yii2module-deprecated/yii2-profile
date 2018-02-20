<?php

namespace yii2module\profile\module\forms;

use Yii;
use yii2module\profile\domain\entities\CarEntity;
use yii2lab\domain\base\Model;

class CarForm extends Model
{
	
	public $gov_number;
	public $document_number;
	
	public function rules()
	{
		$entity = new CarEntity();
		return $entity->rules();
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'gov_number' 		=> Yii::t('profile/car', 'gov_number'),
			'document_number' 		=> Yii::t('profile/car', 'document_number'),
		];
	}
	
}
