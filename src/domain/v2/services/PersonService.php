<?php

namespace yii2module\profile\domain\v2\services;

use yii2lab\domain\helpers\ErrorCollection;
use yii2lab\domain\exceptions\UnprocessableEntityHttpException;
use yii2lab\validator\helpers\IinParser;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PersonService extends BaseService {
	
	public function updateSelf($body) {
		$profile = $this->getSelf();
		$body = ArrayHelper::toArray($body);
		if(!empty($body['iin'])) {
			$profile->iin = $body['iin'];
			$profile->validate();
			/*$profileWithIin = $this->domain->repositories->iin->oneById($body['iin']);
			if($profileWithIin) {
				$body['first_name'] = $profileWithIin->first_name;
				$body['last_name'] = $profileWithIin->last_name;
			}*/
			$this->validateIin($body);
		}
		$this->updateById($profile->id, $body);
	}
	
	private function validateIin($body) {
		try {
			$profileEntityWithIin = $this->domain->repositories->iin->oneById($body['iin']);
		} catch(NotFoundHttpException $e) {
			$error = new ErrorCollection();
			$error->add('iin','profile/person','iin_not_found');
			Throw new UnprocessableEntityHttpException($error);
		}
		$isValidFirstName = mb_strtoupper($body['first_name']) == mb_strtoupper($profileEntityWithIin->first_name);
		$isValidLastName = mb_strtoupper($body['last_name']) == mb_strtoupper($profileEntityWithIin->last_name);
		$error = new ErrorCollection;
		if(!$isValidFirstName) {
			$error->add('first_name', 'profile/person', 'fake_first_name');
		}
		if(!$isValidLastName) {
			$error->add('last_name', 'profile/person', 'fake_last_name');
		}
		$iin = IinParser::parse($body['iin']);
		if(!$body['sex'] == ($iin['sex'] == 'female')) {
			$error->add('sex', 'profile/person', 'fake_sex');
		}
		$date = $iin['date']['year'] . '-' . $iin['date']['month'] . '-' . $iin['date']['day'];
		if($date != $body['birth_date']) {
			$error->add('birth_date', 'profile/person', 'fake_birth_date');
		}
		if($error->count()) {
			throw new UnprocessableEntityHttpException($error);
		}
	}
	
}
