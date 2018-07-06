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
		//prr($query->toArray(),1,1);
		try {
			$entity = parent::oneById($id, $query);
		} catch(NotFoundHttpException $e) {
			$this->create(['id' => $id]);
			$entity = parent::oneById($id, $query);
		}
		return $entity;
	}
	
	public function getSelf(Query $query = null) {
		//prr($query->toArray(),1,1);
		$id = Yii::$app->user->identity->id;
		return $this->oneById($id, $query);
		//prr($this->oneById($id, $query),1,1);
	}
	
	public function updateSelf($body) {
		$entity = $this->getSelf();
		$this->updateById($entity->id, $body);
	}
	
}
