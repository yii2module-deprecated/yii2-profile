<?php

use yii2lab\db\domain\db\MigrationCreateTable as Migration;

class m170724_110102_create_user_profile_table extends Migration
{
	public $table = '{{%user_profile}}';

	/**
	 * @inheritdoc
	 */
	public function getColumns()
	{
		return [
			'login' => $this->string(16),
			'first_name' => $this->string(128)->comment('Имя'),
			'last_name' => $this->string(128)->comment('Фамилия'),
			'iin' => $this->string(128)->comment('ИИН'),
			'birth_date' => $this->date()->comment('Дата рождения'),
			'sex' => $this->integer(1)->comment('пол (0: муж, 1: жен)'),
			'avatar' => $this->string()->comment('Аватар'),
		];
	}

	public function afterCreate()
	{
		$this->myCreateIndexUnique(['login']);
	}

}
