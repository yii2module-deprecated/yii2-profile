<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m170814_102139_create_user_address_table extends Migration
{
	public $table = '{{%user_address}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'login' => $this->string(16),
			'country_id' => $this->integer()->comment('Страна'),
			'region_id' => $this->integer()->comment('Область'),
			'city_id' => $this->integer()->comment('Город'),
			'district' => $this->string()->comment('Район'),
			'street' => $this->string(128)->comment('Улица/мкр.'),
			'home' => $this->string(12)->comment('Номер дома'),
			'apartment' => $this->integer(12)->comment('Квартира'),
			'post_code' => $this->integer()->comment('Почтовый индекс'),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['login']);
	}

}
