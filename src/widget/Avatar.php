<?php

namespace yii2module\profile\widget;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use yii2lab\domain\helpers\ServiceHelper;
use yii2module\profile\domain\v2\entities\AvatarEntity;

class Avatar extends Widget {
	
	public $userId;
	public $service = 'profile.avatar';
	public $height = 19;
	public $entity;
	
	public function run() {
		/** @var AvatarEntity $avatarEntity */
		if(isset($this->entity) && $this->entity instanceof AvatarEntity) {
			$avatarEntity = $this->entity;
		} else {
			$userId = isset($this->userId) ? $this->userId : Yii::$app->user->id;
			$avatarEntity = ServiceHelper::oneById($this->service, $userId);
		}
		if(is_object($avatarEntity) && $avatarEntity instanceof AvatarEntity) {
			echo Html::img($avatarEntity->url, ['height' => $this->height]);
		}
	}
	
}
