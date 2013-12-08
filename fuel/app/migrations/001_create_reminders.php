<?php

namespace Fuel\Migrations;

class Create_reminders
{
	public function up()
	{
		\DBUtil::create_table('reminders', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'message' => array('type' => 'text'),
			'time' => array('type' => 'time'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('reminders');
	}
}