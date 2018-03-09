<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii2module\profile\domain\v2\interfaces\services\AvatarInterface;
use yii2module\profile\domain\v2\repositories\ar\AvatarRepository;

/**
 * Class AvatarService
 *
 * @packageyii2module\profile\domain\v2\services
 *
 * @property AvatarRepository $repository
 */
class AvatarService extends BaseService implements AvatarInterface {
	
	public function updateSelf($avatar) {
		$id = Yii::$app->user->id;
		$name = $this->domain->repositories->avatarUpload->save($avatar, $id);
		$this->changeAvatarInProfile($name);
	}
	
	public function deleteSelf() {
		$id = Yii::$app->user->id;
		$this->domain->repositories->avatarUpload->delete($id);
		$this->changeAvatarInProfile(null);
	}
	
	private function changeAvatarInProfile($name) {
		$id = Yii::$app->user->id;
		$entity = $this->repository->oneById($id);
		$entity->name = $name;
		$this->repository->update($entity);
	}
	
}
