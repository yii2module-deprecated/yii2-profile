<?php

namespace yii2module\profile\domain\v2;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 *
 * @package yii2module\account\domain\v2
 *
 * @property \yii2module\profile\domain\v2\services\ProfileService $profile
 * @property \yii2module\profile\domain\v2\services\PersonService $person
 * @property \yii2module\profile\domain\v2\services\AddressService $address
 * @property \yii2module\profile\domain\v2\services\AvatarService $avatar
 * @property \yii2module\profile\domain\v2\services\IinService $iin
 */
class Domain extends \yii2lab\domain\Domain {
	
	public function config() {
		return [
			'container' => [
				'yii2module\profile\domain\v1\repositories\tps\IinRepository' => 'yii2woop\common\domain\profile\repositories\tps\IinRepository',
			],
			'repositories' => [
				'profile' => Driver::BRIDGE,
				'person' => Driver::slave(),
				'address' => Driver::slave(),
				'avatarUpload' => [
					'driver' => Driver::FLY,
					//'quality' => 90,
					'format' => 'png',
					'size' => 256,
				],
				'avatar' => Driver::slave(),
				'iin' => Driver::TPS,
			],
			'services' => [
				'profile',
				'person',
				'address',
				'avatar' => [
					'defaultName' => 'images/image/no_avatar.png',
				],
				'iin',
			],
		];
	}
	
}