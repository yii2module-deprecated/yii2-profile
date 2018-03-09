<?php

namespace yii2module\profile\domain\v2\repositories\ar;

use yii2lab\domain\repositories\ActiveArRepository;

class AddressRepository extends ActiveArRepository {
	
	public function tableName()
	{
		return 'profile_address';
	}
	
}
