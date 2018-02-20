<?php

namespace yii2module\profile\domain\repositories\tps;

use yii2module\profile\domain\entities\ProfileEntity;
use yii2lab\domain\repositories\TpsRepository;
use yii2lab\validator\helpers\IinParser;
use yii\web\NotFoundHttpException;
use yii2woop\generated\transport\TpsCommands;

class IinRepository extends TpsRepository {
	
	public function oneById($iin) {
		$request = TpsCommands::getClientFioByIIN($iin);
		$response = $this->send($request);
		$fio = trim($response['client_fio']);
		if(empty($fio)) {
			throw new NotFoundHttpException();
		}
		$result = $this->splitNames($fio);
		$result['iin'] = $iin;
		$result = $this->setOtherData($result);
		$entity = $this->forgeEntity($result);
		return $entity;
	}
	
	private function setOtherData($result) {
		$iinData = IinParser::parse($result['iin']);
		$result['sex'] = $iinData['sex'] == 'female';
		$result['birth_date'] = $iinData['date']['year'] . '-' . $iinData['date']['month'] . '-' . $iinData['date']['day'];
		return $result;
	}
	
	private function splitNames($fio) {
		$fioArray = explode(' ', $fio);
		$result = [];
		if(count($fioArray) > 0) {
			$result['last_name'] = $fioArray[0];
		}
		if(count($fioArray) > 1) {
			$result['first_name'] = $fioArray[1];
		}
		return $result;
	}
	
	public function forgeEntity($data, $class = null) {
		$class = ProfileEntity::className();
		return parent::forgeEntity($data, $class);
	}
}