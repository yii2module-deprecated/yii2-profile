<?php

namespace yii2module\profile\domain\entities;

use yii2lab\domain\BaseEntity;
use yii2lab\validator\IinValidator;
use Yii;
use yii\validators\DateValidator;

class ProfileEntity extends BaseEntity {
	
	protected $login;
	protected $first_name;
	protected $last_name;
	protected $iin;
	protected $birth_date;
	protected $sex;
	protected $avatar;
	protected $avatar_url;

	public function fieldType() {
		return [
			'iin' => 'string',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$maxBirthDate = time() - 60 * 60 * 24;
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
	
	public function getAvatarUrl() {
		if(empty($this->avatar_url)) {
			$repository = Yii::$app->profile->repositories->avatar;
			if(empty($this->avatar)) {
				$this->avatar_url = env('servers.static.domain') . $repository->defaultName;
			} else {
				$baseUrl = env('servers.static.domain') . param('static.path.avatar') . '/';
				$this->avatar_url = $baseUrl . $this->avatar . '.' . $repository->format;
			}
		}
		return $this->avatar_url;
	}
	
}
