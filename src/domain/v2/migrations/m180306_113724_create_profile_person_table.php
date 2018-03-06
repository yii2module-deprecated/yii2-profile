<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m180306_113724_create_profile_person_table extends Migration
{
	public $table = '{{%profile_person}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'id' => $this->integer(),
			'first_name' => $this->string(128)->comment('Имя'),
			'last_name' => $this->string(128)->comment('Фамилия'),
			'iin' => $this->string(128)->comment('ИИН'),
			'birth_date' => $this->date()->comment('Дата рождения'),
			'sex' => $this->integer(1)->comment('пол (0: муж, 1: жен)'),
		];
	}

	public function afterCreate()
	{
		$this->myAddPrimaryKey(['id']);
	}

}
