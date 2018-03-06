<?php

namespace yii2module\profile\domain\v2\services;

use yii2module\profile\domain\v2\repositories\upload\AvatarRepository;
use yii2lab\domain\services\ActiveBaseService;
use Yii;

/**
 * Class AvatarService
 *
 * @packageyii2module\profile\domain\v2\services
 *
 * @property AvatarRepository $repository
 */
class AvatarService extends ActiveBaseService {
	
	public function getSelf() {
		$profile = $this->domain->person->getSelf();
		$entity = $this->repository->forgeEntity([
			'name' => $profile->avatar,
			'url' => $profile->avatar_url,
		]);
		return $entity;
	}
	
	public function updateSelf($avatar) {
		$name = $this->repository->save($avatar, Yii::$app->user->id);
		$this->changeAvatarInProfile($name);
	}
	
	public function deleteSelf() {
		$this->domain->repositories->avatar->delete(Yii::$app->user->id);
		$this->changeAvatarInProfile(null);
	}
	
	private function changeAvatarInProfile($name) {
		$profile = $this->domain->person->getSelf();
		$body['avatar'] = $name;
		$this->domain->person->updateById($profile->login, $body);
	}
	
}
