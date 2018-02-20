<?php

namespace yii2module\profile\module\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii2lab\helpers\Behavior;

class QrController extends Controller {
	
	public function behaviors() {
		return [
			'access' => Behavior::access('@'),
		];
	}
	
	public function actionIndex($action = false) {
		$entity = Yii::$app->profile->qr->getSelf();
		if($action == 'download') {
			Yii::$app->response->xSendFile($entity->path);
		}
		if($action == 'print') {
			return $this->render('qr_print', ['link' => $entity->text]);
		}
		return $this->render('qr', ['link' => $entity->text]);
	}
	
}