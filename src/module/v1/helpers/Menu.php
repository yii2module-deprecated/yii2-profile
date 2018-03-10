<?php

namespace yii2module\profile\module\v1\helpers;

use Yii;
use yii2lab\extension\menu\interfaces\MenuInterface;

class Menu implements MenuInterface {
	
	public function toArray() {
		$items = [
			[
				'url' => 'profile/person',
				'icon' => 'address-card-o',
				'label' => ['profile/person', 'title'],
				'visible' => true,
			],
			[
				'url' => 'profile/avatar',
				'icon' => 'user-o',
				'label' => ['profile/avatar', 'title'],
				'visible' => true,
			],
			[
				'url' => 'profile/address',
				'icon' => 'map-marker',
				'label' => ['profile/address', 'title'],
				'visible' => true,
			],
			[
				'url' => 'profile/car',
				'icon' => 'car',
				'label' => ['profile/car', 'title'],
				'visible' => false,
			],
			[
				'url' => 'profile/security',
				'icon' => 'lock',
				'label' => ['profile/security', 'title'],
				'visible' => true,
			],
			[
				'url' => 'profile/qr',
				'icon' => 'qrcode',
				'label' => ['profile/qr', 'title'],
				'visible' => false,
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
