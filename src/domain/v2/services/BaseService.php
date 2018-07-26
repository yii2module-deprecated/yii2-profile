<?php

namespace yii2module\profile\domain\v2\services;

use yii\web\NotFoundHttpException;
use yii2lab\domain\data\Query;
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
class BaseService extends ActiveBaseService {
	
	public function oneById($id, Query $query = null) {
		try {
			$entity = parent::oneById($id, $query);
		} catch(NotFoundHttpException $e) {
			$this->create(['id' => $id]);
			$entity = parent::oneById($id, $query);
		}
		return $entity;
	}
	
	public function getSelf(Query $query = null) {
		$id = Yii::$app->user->identity->id;
		try {
			return $this->oneById($id, $query);
		} catch(NotFoundHttpException $e) {
			
		}
	}
	
	public function updateSelf($body) {
		$entity = $this->getSelf();
		$this->updateById($entity->id, $body);
	}
	
}
