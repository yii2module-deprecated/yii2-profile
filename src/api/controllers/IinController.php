<?php

namespace yii2module\profile\api\controllers;

use yii2lab\domain\rest\ActiveController as Controller;

class IinController extends Controller
{

	public $serviceName = 'profile.iin';

	public function format() {
		return [
			'creation_date' => 'time:api',
			'birth_date' => 'time:api',
		];
	}

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