<?php

namespace yii2module\profile\api\v2\controllers;

use yii2lab\domain\rest\ActiveController as Controller;

class IinController extends Controller
{

	public $serviceName = 'profile.iin';

	/**
	 * @inheritdoc
	 */
	public function actions() {
		return [
			'view' => [
				'class' => 'yii2lab\domain\rest\ViewActionWithQuery',
			],
		];
	}

}