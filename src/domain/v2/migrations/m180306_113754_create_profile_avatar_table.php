<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m180306_113754_create_profile_avatar_table extends Migration
{
	public $table = '{{%profile_avatar}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->integer(),
			'name' => $this->string()->comment('Аватар'),
		];
	}

	public function afterCreate()
	{
		$this->myAddPrimaryKey(['id']);
	}

}
