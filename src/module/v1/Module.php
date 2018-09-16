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
		
		//Yii::$app->view->title = Yii::t($moduleId . SL . $controllerId, 'title');
		\App::$domain->navigation->breadcrumbs->create([$this->id . SL . 'main', 'title'], [SL . $this->id]);
		//\App::$domain->navigation->breadcrumbs->create([$this->moduleLangId(), 'title']);
		return parent::beforeAction($action);
	}
	
	public function moduleLangId() {
		return $this->id . SL . Yii::$app->controller->id;
	}
	
}
