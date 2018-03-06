<?php

namespace yii2module\profile\domain\v1\services;

use yii2lab\domain\data\Query;
use yii2lab\domain\services\ActiveBaseService;
use yii2lab\validator\helpers\IinParser;
use Exception;
use yii\web\NotFoundHttpException;

class IinService extends ActiveBaseService {

	public function oneById($id, Query $query = null) {
		try {
			IinParser::parse($id);
		} catch (Exception $e) {
			throw new NotFoundHttpException();
		}
		return parent::oneById($id, $query);
	}
	
}
