<?php

namespace yii2module\profile\module\v1\controllers;

use yii2lab\helpers\Behavior;
use Yii;
use yii\web\Controller;

abstract class BaseController extends Controller {
	
	public function behaviors() {
		return [
			'access' => Behavior::access('@'),
		];
	}

    public function beforeAction($action)
    {
        Yii::$app->view->title = Yii::t('profile/' . $this->id, 'title');
        Yii::$app->navigation->breadcrumbs->create(['profile/main', 'title']/*, '/profile/person'*/);
        Yii::$app->navigation->breadcrumbs->create(['profile/' . $this->id, 'title']);
        return parent::beforeAction($action);
    }

}