<?php

namespace Fuel\Migrations;

class Create_customers
{
	public function up()
	{
		\DBUtil::create_table('customers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'imei' => array('constraint' => 50, 'type' => 'varchar'),
			'balance' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'default' => 0),
			'status' => array('constraint' => 2, 'type' => 'tinyint'),
			'active_date' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'extension_date' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'expire_date' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('customers');
	}
}