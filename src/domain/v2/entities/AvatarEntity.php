<?php

namespace yii2module\profile\domain\v2\entities;

use Yii;
use yii2lab\app\domain\helpers\EnvService;
use yii2lab\domain\BaseEntity;
use yii2module\profile\domain\v2\enums\SummaryEnum;

/**
 * Class AvatarEntity
 *
 * @package yii2module\profile\domain\v2\entities
 * @property integer $id
 * @property $name string|null
 * @property-read $url
 */
class AvatarEntity extends BaseEntity {
	
	protected $id;
	protected $name;
	
	public function getUrl() {
		if(empty($this->name)) {
			return EnvService::getStaticUrl(Yii::$domain->profile->avatar->defaultName);
		} else {
			$fileName = $this->name . DOT . Yii::$domain->profile->repositories->avatarUpload->format;
			$baseUrl = Yii::$domain->summary->summary->getStaticUrl(SummaryEnum::AVATAR_URL);
			return $baseUrl . SL . $fileName;
		}
	}
	
	public function fields() {
		return [
			'id',
			'name',
			'url',
		];
	}
}
