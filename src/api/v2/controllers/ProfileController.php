<?php

namespace yii2module\profile\api\v2\controllers;

use yii2lab\rest\domain\rest\Controller;
use yii2lab\helpers\Behavior;

class ProfileController extends Controller
{

	public $service = 'profile.profile';

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'authenticator' => Behavior::apiAuth(),
			'verb' => Behavior::verb([
				'view' => ['GET'],
			]),
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
		];
	}

}