<?php

namespace yii2module\profile\domain\v2\entities;

use Yii;
use yii2lab\domain\BaseEntity;

class AvatarEntity extends BaseEntity {
	
	protected $id;
	protected $name;
	protected $url;
	
	public function getUrl() {
		if(empty($this->url)) {
			$repository = Yii::$app->profile->repositories->avatar;
			if(empty($this->name)) {
				$this->url = env('servers.static.domain') . $repository->defaultName;
			} else {
				$baseUrl = env('servers.static.domain') . param('static.path.avatar') . '/';
				$this->url = $baseUrl . $this->name . '.' . Yii::$app->profile->repositories->avatarUpload->format;
			}
		}
		return $this->url;
	}
}
