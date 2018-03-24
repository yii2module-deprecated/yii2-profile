<?php

namespace yii2module\profile\domain\v2\interfaces\services;

use yii2lab\domain\interfaces\services\CrudInterface;

interface AvatarInterface extends CrudInterface {
	
	public function getSelf();
	public function updateSelf($avatar);
	public function deleteSelf();

}