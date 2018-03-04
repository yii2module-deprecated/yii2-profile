<?php

namespace yii2module\profile\api\controllers;

use yii2lab\domain\rest\Controller;
use yii2lab\helpers\Behavior;

class PersonController extends Controller
{

	public $serviceName = 'profile.person';

	public function format() {
		return [
			'sex' => 'boolean',
			'birth_date' => 'time:api',
		];
	}

	public function getSelf() {
		return $this->repository->getSelf();
	}
	
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