<?php

namespace yii2module\profile\module\v1\controllers;

use Yii;
use yii\web\Controller;
use yii2lab\domain\data\Query;

/**
 * @property \yii2module\profile\module\v1\Module $module
 */
class DefaultController extends Controller {
	
	public function actionIndex()
	{
		$query = Query::forge();
		$query->with([
			'address',
			'avatar',
			'person',
		]);
		$profileEntity = \App::$domain->profile->profile->getSelf($query);
		//prr($profileEntity,1,1);
		return $this->render('index', [
			'profileEntity' => $profileEntity,
		]);
	}
	
}