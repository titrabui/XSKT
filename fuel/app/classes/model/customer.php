<?php

class Model_Customer extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'imei',
		'balance',
		'status',
		'active_date',
		'extension_date',
		'expire_date',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'customers';

	protected static $_has_many = array('users' => array(
		'model_to'       => 'Model_User',
		'key_from'       => 'id',
		'key_to'         => 'user_id',
		//'cascade_save'   => true,
		//'cascade_delete' => true,
	));
}
