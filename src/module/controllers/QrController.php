<?php

namespace yii2module\profile\module\controllers;

use Yii;

class QrController extends BaseController {

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