<?php

namespace Fuel\Migrations;

class Create_customer_requests
{
	public function up()
	{
		\DBUtil::create_table('customer_requests', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'imei' => array('constraint' => 50, 'type' => 'varchar'),
			'status' => array('constraint' => 1, 'type' => 'tinyint'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		\DBUtil::create_index('customer_requests', array('imei'), 'imei', 'UNIQUE');
	}

	public function down()
	{
		\DBUtil::drop_table('customer_requests');
	}
}