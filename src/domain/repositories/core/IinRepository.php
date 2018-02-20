<?php

namespace yii2module\profile\domain\repositories\core;

use yii2module\profile\domain\entities\ProfileEntity;
use yii2lab\domain\repositories\ActiveCoreRepository;
use common\enums\app\ApiVersionEnum;

class IinRepository extends ActiveCoreRepository {
	
	public $version = ApiVersionEnum::VERSION_4;
	public $baseUri = 'user-iin';
	
	public function forgeEntity($data, $class = null) {
		$class = ProfileEntity::className();
		return parent::forgeEntity($data, $class);
	}
	
}