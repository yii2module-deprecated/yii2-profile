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
	protected $post_code;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['post_code', 'district', 'street', 'home'], 'trim'],
			[['country_id', 'region_id', 'city_id', 'apartment', 'post_code'], 'integer'],
			['post_code', 'string', 'length' => 6],
		];
	}
	
}
