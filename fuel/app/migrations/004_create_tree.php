<?php

namespace Fuel\Migrations;

class Create_tree
{
	public function up()
	{
		\DBUtil::create_table('tree', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'left_id' => array('constraint' => 11, 'type' => 'int', 'key' => true, 'unsigned' => true),
			'right_id' => array('constraint' => 11, 'type' => 'int', 'key' => true, 'unsigned' => true),
			'tree_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true, 'null' => true),

		), array('id'));

		// add a unique index on left_id and right_id
		\DBUtil::create_index('tree', array('left_id', 'right_id'), 'left_id', 'UNIQUE');
	}

	public function down()
	{
		\DBUtil::drop_table('tree');
	}
}
