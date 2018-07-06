<?php

namespace yii2module\profile\domain\v2\repositories\disc;

use yii2lab\domain\repositories\ActiveDiscRepository;

class AddressRepository extends ActiveDiscRepository {
	
	public $table = 'profile_address';
	protected $schemaClass = true;
	
}
