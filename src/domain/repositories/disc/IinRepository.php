<?php

namespace yii2module\profile\domain\repositories\disc;

use yii2module\profile\domain\entities\PersonEntity;
use yii2lab\domain\repositories\ActiveDiscRepository;

class IinRepository extends ActiveDiscRepository {
	
	public $table = 'iin';

	public function forgeEntity($data, $class = null) {
		return parent::forgeEntity($data, PersonEntity::class);
	}

}