<?php

namespace yii2module\profile\api\v1\controllers;

use yii2lab\rest\domain\rest\Controller;
use yii2lab\extension\web\helpers\Behavior;

class CarController extends Controller
{

	public $service = 'profile.car';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'authenticator' => Behavior::auth(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'view' => [
				'class' => 'yii2lab\domain\rest\IndexActionWithQuery',
				'serviceMethod' => 'getSelf',
			],
			'update' => [
				'class' => 'yii2lab\domain\rest\CreateAction',
				'serviceMethod' => 'updateSelf',
				'successStatusCode' => 204,
			],
		];
	}

}