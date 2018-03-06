<?php

namespace yii2module\profile\domain\v2\services;

use yii\web\NotFoundHttpException;
use yii2lab\domain\services\ActiveBaseService;
use Yii;
use yii2module\profile\domain\v2\repositories\ar\AvatarRepository;

/**
 * Class AvatarService
 *
 * @packageyii2module\profile\domain\v2\services
 *
 * @property AvatarRepository $repository
 */
class AvatarService extends ActiveBaseService {
	
	public function getSelf() {
		$id = Yii::$app->user->identity->id;
		try {
			$entity = $this->repository->oneById($id);
		} catch(NotFoundHttpException $e) {
			$entity = $this->domain->factory->entity->create('avatar', [
				'id' => $id,
			]);
		}
		return $entity;
	}
	
	public function updateSelf($avatar) {
		$name = $this->domain->repositories->avatarUpload->save($avatar, Yii::$app->user->id);
		$this->changeAvatarInProfile($name);
	}
	
	public function deleteSelf() {
		$this->domain->repositories->avatarUpload->delete(Yii::$app->user->id);
		$this->changeAvatarInProfile(null);
	}
	
	private function changeAvatarInProfile($name) {
		$id = Yii::$app->user->id;
		$entity = $this->repository->oneById($id);
		$entity->name = $name;
		$this->repository->update($entity);
	}
	
}
