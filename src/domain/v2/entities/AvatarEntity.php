<?php

namespace yii2module\profile\domain\v2\entities;

use Yii;
use yii2lab\domain\BaseEntity;

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
			return env('servers.static.domain') . Yii::$app->profile->repositories->avatar->defaultName;
		} else {
			$baseUrl = env('servers.static.domain') . param('static.path.avatar') . '/';
			return $baseUrl . $this->name . '.' . Yii::$app->profile->repositories->avatarUpload->format;
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
