<?php

namespace yii2module\profile\domain\v2\entities;

use yii2lab\domain\BaseEntity;

class AddressEntity extends BaseEntity {
	
	protected $id;
	protected $country_id;
	protected $region_id;
	protected $city_id;
	protected $district;
	protected $street;
	protected $home;
	protected $apartment;
	protected $zip_code;
	protected $city;
	protected $region;
	protected $country;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['zip_code', 'district', 'street', 'home'], 'trim'],
			[['country_id', 'region_id', 'city_id', 'apartment', 'zip_code'], 'integer'],
			['zip_code', 'string', 'length' => 6],
		];
	}
	
}
