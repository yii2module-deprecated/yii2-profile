<?php

namespace yii2module\profile\api\controllers;

use yii2lab\domain\rest\ActiveControllerWithQuery as Controller;
use Yii;
use yii2lab\helpers\Behavior;

class ActiveController extends Controller
{
	
	public $serviceName = 'profile.active';
	
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
