<?php

class Model_Verification extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'verify_code',
		'imei',
		'phone',
		'expiration',
		'created_at',
		'updated_at'
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

	protected static $_table_name = 'verifications';

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		switch ($factory) {
			case 'code_verification':
				$val->add_field('imei', 'Imei', 'required|max_length[50]');
				$val->add_field('verify_code', 'Verify code', 'required|valid_string[numeric]|max_length[4]');
				break;

			case 'admin_verification':
				$val->add_field('admin', 'Admin', 'required|max_length[50]');
				break;

			default:
				$val->add_field('imei', 'Imei', 'required|max_length[50]');
				$val->add_field('phone', 'Phone number', 'required|valid_string[numeric]|max_length[25]');
				break;
		}

		return $val;
	}
}
