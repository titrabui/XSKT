<?php

class Model_Customer_Request extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'user_id',
		'imei',
		'status', // 0: denied, 1: waiting for accepting
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

	protected static $_table_name = 'customer_requests';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		switch ($factory) {
			case 'admin_request':
				$val->add_field('admin_id', 'Admin', 'required|valid_string[numeric]');
				$val->add_field('customer_request_id', 'Admin', 'required|valid_string[numeric]');
				break;

			default:
				break;
		}

		return $val;
	}
}
