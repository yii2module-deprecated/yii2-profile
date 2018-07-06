<?php

namespace yii2module\profile\domain\v2\repositories\schema;

use yii2lab\domain\enums\RelationEnum;
use yii2lab\domain\repositories\relations\BaseSchema;

class AddressSchema extends BaseSchema {
	
	public function relations() {
		return [
			'city' => [
				'type' => RelationEnum::ONE,
				'field' => 'city_id',
				'foreign' => [
					'id' => 'geo.city',
					'field' => 'id',
				],
			],
			'country' => [
				'type' => RelationEnum::ONE,
				'field' => 'country_id',
				'foreign' => [
					'id' => 'geo.country',
					'field' => 'id',
				],
			],
			'region' => [
				'type' => RelationEnum::ONE,
				'field' => 'region_id',
				'foreign' => [
					'id' => 'geo.region',
					'field' => 'id',
				],
			],
			
		];
	}
	
}
