<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m180306_113734_create_profile_address_table extends Migration
{
	public $table = '{{%profile_address}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->integer(),
			'country_id' => $this->integer()->comment('Страна'),
			'region_id' => $this->integer()->comment('Область'),
			'city_id' => $this->integer()->comment('Город'),
			'district' => $this->string()->comment('Район'),
			'street' => $this->string(128)->comment('Улица/мкр.'),
			'home' => $this->string(12)->comment('Номер дома'),
			'apartment' => $this->integer(12)->comment('Квартира'),
			'zip_code' => $this->integer()->comment('Почтовый индекс'),
		];
	}

	public function afterCreate()
	{
		$this->myAddPrimaryKey(['id']);
	}

}
