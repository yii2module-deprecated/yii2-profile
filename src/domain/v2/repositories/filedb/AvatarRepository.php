<?php

namespace yii2module\profile\domain\v2\repositories\filedb;

use yii2lab\domain\repositories\ActiveFiledbRepository;

class AvatarRepository extends ActiveFiledbRepository {
	
	public function tableName()
	{
		return 'profile_avatar';
	}
	
}
