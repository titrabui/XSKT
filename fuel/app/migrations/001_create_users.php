<?php

namespace Fuel\Migrations;

class Create_users
{
	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'left_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'right_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'username' => array('constraint' => 50, 'type' => 'varchar'),
			'password' => array('constraint' => 50, 'type' => 'varchar'),
			'group' => array('constraint' => 11, 'type' => 'int', 'default' => 1),
			'status' => array('constraint' => 1, 'type' => 'tinyint'),
			'email' => array('constraint' => 255, 'type' => 'varchar'),
			'last_login' => array('constraint' => 25, 'type' => 'varchar'),
			'login_hash' => array('constraint' => 255, 'type' => 'varchar'),
			'balance' => array('constraint' => 11, 'type' => 'int', 'null' => true, 'unsigned' => true, 'default' => 0),
			'profile_fields' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}