<?php

namespace yii2module\profile\api\v1\controllers;

use yii2lab\rest\domain\rest\Controller;
use yii2lab\helpers\Behavior;

class AddressController extends Controller
{

	public $service = 'profile.address';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'authenticator' => Behavior::apiAuth(),
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