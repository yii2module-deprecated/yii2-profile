<?php

namespace yii2module\profile\module\v1;

use Yii;
use yii\base\Module as YiiModule;
use yii2lab\helpers\Behavior;

/**
 * user module definition class
 */
class Module extends YiiModule
{
	
	public $actionList;
	
	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
			'access' => Behavior::access('@'),
		];
	}
	
	public function beforeAction($action) {
		$controllerId = Yii::$app->controller->id;
		$moduleId = $this->id;
		//Yii::$app->view->title = Yii::t($moduleId . SL . $controllerId, 'title');
		Yii::$app->navigation->breadcrumbs->create([$moduleId . SL . 'main', 'title']);
		Yii::$app->navigation->breadcrumbs->create([$moduleId . SL . $controllerId, 'title']);
		return parent::beforeAction($action);
	}
	
}
