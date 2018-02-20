<?php

namespace yii2module\profile\module\helpers;

use Yii;

class Menu {
	
	public function toArray() {
		$actionList = config('modules.profile.actionList', []);
		$items = [
			[
				'url' => 'profile/person',
				'icon' => 'address-card-o',
				'label' => ['profile/profile', 'person_title'],
				'visible' => in_array('person', $actionList),
			],
			[
				'url' => 'profile/address',
				'icon' => 'map-marker',
				'label' => ['profile/profile', 'address_title'],
				'visible' => in_array('address', $actionList),
			],
			[
				'url' => 'profile/car',
				'icon' => 'car',
				'label' => ['profile/profile', 'car_title'],
				'visible' => in_array('car', $actionList),
			],
			[
				'url' => 'profile/security',
				'icon' => 'lock',
				'label' => ['profile/profile', 'security_title'],
				'visible' => in_array('security', $actionList),
			],
			[
				'url' => 'profile/qr',
				'icon' => 'qrcode',
				'label' => ['profile/profile', 'qr_title'],
				'visible' => in_array('qr', $actionList),
			],
		];
		$items = $this->filter($items);
		return $items;
	}
	
	private function filter($items) {
		foreach($items as &$item) {
			$item['active'] = trim(Yii::$app->request->url, SL) == $item['url'];
			/*if(!empty($item['icon'])) {
				$item['label'] = $item['icon'] . SPC . $item['label'];
				unset($item['icon']);
				$item['encode'] = false;
			}*/
		}
		return $items;
	}

}
