<?php

namespace Fuel\Migrations;

class Create_customer_logs
{
	public function up()
	{
		\DBUtil::create_table('customer_logs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'customer_id' => array('constraint' => 11, 'type' => 'int'),
			'logs' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('customer_logs');
	}
}