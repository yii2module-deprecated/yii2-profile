<?php

namespace yii2module\profile\domain\v2\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\domain\values\TimeValue;
use yii2lab\extension\enum\enums\TimeEnum;
use yii2lab\validator\IinValidator;
use Yii;
use yii\validators\DateValidator;
use yii2module\account\domain\v2\helpers\LoginHelper;

/**
 * Class PersonEntity
 *
 * @package yii2module\profile\domain\v2\entities
 *
 * @property $id
 * @property $first_name
 * @property $last_name
 * @property $iin
 * @property $birth_date
 * @property $sex
 * @property $title
 */
class PersonEntity extends BaseEntity {
	
	protected $id;
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

	public function getTitle() {
		$title = ucfirst($this->first_name) . SPC . ucfirst($this->last_name);
		$title = trim($title);
		if(!$title) {
			$title = \App::$domain->account->auth->identity->login;
			if(LoginHelper::validate($title)) {
				$title = LoginHelper::format($title);
			}
		}
		return $title;
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		//$maxBirthDate = time() - TimeEnum::SECOND_PER_DAY;
		return [
			[['first_name', 'last_name', 'iin', 'birth_date'], 'trim'],
			[['first_name', 'last_name'], 'match', 'pattern'=>'/^[a-zа-яё]+$/iu', 'message' => Yii::t('profile/person', 'invalid_format_name')],
			/*[
				'birth_date',
				DateValidator::class,
				'type' => DateValidator::TYPE_DATE,
				'format' => 'yyyy-MM-dd',
				'max' => date('Y-m-d', $maxBirthDate)
			],*/
			[['sex'], 'boolean'],
			['iin', IinValidator::class],
		];
	}
	
}
