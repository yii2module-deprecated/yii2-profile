<?php

namespace yii2module\profile\domain\v2;

use yii2lab\domain\enums\Driver;

/**
 * Class Domain
 * 
 * @package yii2module\account\domain\v2
 * @property-read \yii2module\profile\domain\v2\interfaces\services\AvatarInterface $avatar
 * @property-read \yii2module\profile\domain\v2\interfaces\repositories\RepositoriesInterface $repositories
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