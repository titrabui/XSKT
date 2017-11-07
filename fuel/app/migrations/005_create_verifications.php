<?php

namespace Fuel\Migrations;

class Create_verifications
{
	public function up()
	{
		\DBUtil::create_table('verifications', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'verify_code' => array('constraint' => 25, 'type' => 'varchar', 'key' => true),
			'imei' => array('constraint' => 50, 'type' => 'varchar', 'key' => true),
			'phone' => array('constraint' => 25, 'type' => 'varchar'),
			'expiration' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));

		\DBUtil::create_index('verifications', array('verify_code', 'imei'), 'imei', 'UNIQUE');
	}

	public function down()
	{
		\DBUtil::drop_table('verifications');
	}
}