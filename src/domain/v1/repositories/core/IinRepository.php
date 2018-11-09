<?php

namespace yii2module\profile\domain\v1\repositories\core;

use yii2module\profile\domain\v1\entities\PersonEntity;
use yii2lab\domain\repositories\ActiveCoreRepository;

class IinRepository extends ActiveCoreRepository {
	
	public $version = 'v4';
	public $baseUri = 'user-iin';
	
	public function forgeEntity($data, $class = null) {
		$class = PersonEntity::class;
		return parent::forgeEntity($data, $class);
	}
	
}