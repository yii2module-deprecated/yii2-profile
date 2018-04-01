<?php

namespace yii2module\profile\domain\v2\interfaces\repositories;

interface AvatarInterface {

	public function save($avatar, $id);
	public function delete($id);

}