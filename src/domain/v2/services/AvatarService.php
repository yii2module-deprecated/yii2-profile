<?php

namespace yii2module\profile\domain\v2\services;

use Yii;
use yii\web\UploadedFile;
use yii2module\profile\domain\v2\entities\AvatarEntity;
use yii2module\profile\domain\v2\interfaces\services\AvatarInterface;
use yii2module\profile\domain\v2\repositories\ar\AvatarRepository;

/**
 * Class AvatarService
 *
 * @package yii2module\profile\domain\v2\services
 *
 * @property AvatarRepository $repository
 */
class AvatarService extends BaseService implements AvatarInterface {
	
	public $defaultName = 'default';
	
	public function updateSelf($avatar) {
		$userId = Yii::$app->user->id;
		$this->deleteSelf();
		$this->uploadByUserId($userId, $avatar);
	}
	
	public function deleteSelf() {
		$userId = Yii::$app->user->id;
		$this->deleteImagesByUserId($userId);
		$this->changeAvatarInProfile($userId, null);
	}
	
	private function uploadByUserId($userId, UploadedFile $avatar) {
		$name = $this->domain->repositories->avatarUpload->save($avatar, $userId);
		if($name) {
			$this->deleteImagesByUserId($userId);
			$this->changeAvatarInProfile($userId, $name);
		}
	}
	
	private function deleteImagesByUserId($userId) {
		/** @var AvatarEntity $entity */
		$entity = $this->repository->oneById($userId);
		$this->domain->repositories->avatarUpload->delete($entity->name);
	}
	
	private function changeAvatarInProfile($userId, $name) {
		$entity = $this->repository->oneById($userId);
		$entity->name = $name;
		$this->repository->update($entity);
	}
	
}
