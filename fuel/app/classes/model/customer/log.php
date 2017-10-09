<?php

class Model_Customer_Log extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'customer_id',
		'logs',
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

	protected static $_table_name = 'customer_logs';

	protected static $_has_many = array('customers' => array(
		'model_to'       => 'Model_Customer',
		'key_from'       => 'id',
		'key_to'         => 'customer_id',
		//'cascade_save'   => true,
		'cascade_delete' => true,
	));
}
