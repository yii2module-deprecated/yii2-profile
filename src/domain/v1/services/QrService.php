<?php

namespace yii2module\profile\domain\v1\services;

use yii2lab\app\domain\helpers\EnvService;
use yii2lab\extension\common\helpers\UrlHelper;
use Yii;
use yii2lab\domain\services\ActiveBaseService;

class QrService extends ActiveBaseService {
	
	public function getSelf() {
		$identity = Yii::$app->user->identity;
		$qrData['account'] = $identity->login;
		$qrData['action'] = 'convertation-to-account';
		$url = $this->genUrl('convertation/to-account', $qrData);
		$entity = \App::$domain->qr->generator->generate($url);
		return $entity;
	}
	
	private function genUrl($uri, $data) {
		$getParams = UrlHelper::generateGetParameters($data);
		$url = EnvService::getUrl('frontend', $uri . '?' . $getParams);
		return $url;
	}
}
