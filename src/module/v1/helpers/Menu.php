<?php

namespace yii2module\profile\module\v1\helpers;

use Yii;
use yii2lab\domain\helpers\ServiceHelper;
use yii2lab\extension\menu\interfaces\MenuInterface;
use yii2lab\extension\common\helpers\ModuleHelper;

class Menu implements MenuInterface {
	
	public function toArray() {
		return [
			[
				'label' => ['profile/main','title'],
				'url' => 'profile',
				'module' => 'profile',
				'domain' => 'profile',
				'access' => ['@'],
				'active' => Yii::$app->controller->module->id == 'profile',
				'visible' => ModuleHelper::has('profile', FRONTEND) && ServiceHelper::has('profile.person'),
			],
		];
	}
	
}
