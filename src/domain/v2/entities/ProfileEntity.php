<?php

namespace yii2module\profile\domain\v2\entities;

use yii2lab\domain\BaseEntity;

/**
 * Class ProfileEntity
 *
 * @package yii2module\profile\domain\v2\entities
 * @property PersonEntity $person
 * @property AddressEntity $address
 * @property AvatarEntity $avatar
 */
class ProfileEntity extends BaseEntity {
	
	protected $id;
	protected $login;
	protected $person;
	protected $address;
	protected $avatar;

}
