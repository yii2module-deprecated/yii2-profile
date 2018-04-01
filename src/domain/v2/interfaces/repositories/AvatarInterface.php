<?php

namespace yii2module\profile\domain\v2\interfaces\repositories;

use yii\web\UploadedFile;

interface AvatarInterface {

	public function save(UploadedFile $avatar, $id);
	public function delete($id);

}