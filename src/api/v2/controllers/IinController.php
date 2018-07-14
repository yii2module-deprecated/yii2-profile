<?php

namespace yii2module\profile\api\v2\controllers;

use yii2lab\rest\domain\rest\ActiveController as Controller;

class IinController extends Controller
{

	public $service = 'profile.iin';

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