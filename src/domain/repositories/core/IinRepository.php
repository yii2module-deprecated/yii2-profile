<?php

namespace yii2module\profile\domain\repositories\core;

use yii2module\profile\domain\entities\PersonEntity;
use yii2lab\domain\repositories\ActiveCoreRepository;
use common\enums\app\ApiVersionEnum;

class IinRepository extends ActiveCoreRepository {
	
	public $version = 'v4';
	public $baseUri = 'user-iin';
	
	public function forgeEntity($data, $class = null) {
		$class = PersonEntity::class;
		return parent::forgeEntity($data, $class);
	}
	
}