<?php

namespace yii2module\profile\api\v1\controllers;

use yii2lab\rest\domain\rest\ActiveControllerWithQuery as Controller;
use Yii;
use yii2lab\helpers\Behavior;

class ActiveController extends Controller
{
	
	public $service = 'profile.active';
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'authenticator' => Behavior::apiAuth(),
		];
	}
	
	public function actions() {
		$actions = parent::actions();
		$actions['update']['serviceMethod'] = 'updateDataById';
		$actions['create']['serviceMethod'] = 'createData';
		return $actions;
	}

}
