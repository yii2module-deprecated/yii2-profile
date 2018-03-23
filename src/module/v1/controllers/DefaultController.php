<?php

namespace yii2module\profile\module\v1\controllers;

use yii\web\Controller;
use yii2module\profile\module\v1\helpers\SettingsMenu;

class DefaultController extends Controller {
	
	public function actionIndex()
	{
		$menuInstance = new SettingsMenu();
		$menu = $menuInstance->toArray();
		$url = $menu[0]['url'];
		$this->redirect([SL . $url]);
	}
	
}