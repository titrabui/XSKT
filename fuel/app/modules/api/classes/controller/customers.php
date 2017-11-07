<?php
namespace Api;
use ErrorException;

class Controller_Customers extends Controller_Base {

	public function before()
	{
		parent::before();
	}

	/**
	 * The getting customer verify code.
	 *
	 * @access  public
	 * @return  Http code
	 */
	public function post_get_code()
	{
		$val = \Model_Verification::validate('verification');
		if ( ! $val->run()) return $this->error_response($val->error());

		// send verify code by SMS
		$verify_code = $this->random_verify_code();
		// if ($this->send_SMS($verify_code) == 'error')
		// return $this->error_response('get verify code failed');

		try
		{
			$verification = \Model_Verification::forge(array(
				'verify_code' => $verify_code,
				'imei'        => \Input::post('imei'),
				'phone'       => \Input::post('phone'),
				'expiration'  => time() + 300 // Add 5 minutes
			));

			// save verification
			if ( ! ($verification and $verification->save()))
				return $this->error_response('Could not registered this imei');

			return $this->success_response($verify_code);
		}
		catch (\Exception $e)
		{
			return $this->error_response($e->getMessage());
		}
	}

	/**
	 * The code verification confirmation function.
	 *
	 * @access  public
	 * @return  Http code
	 */
	public function post_confirm_code()
	{
		$instance = \Database_Connection::instance();
		$instance->start_transaction();

		try
		{
			$val = \Model_Verification::validate('code_verification');
			if ( ! $val->run()) throw new \Exception($this->response($val->error()));

			$verification = \Model_Verification::query()
					->where('verify_code', \Input::post('verify_code'))
					->and_where_open()
						->where('imei', \Input::post('imei'))
					->and_where_close()
					->from_cache(false)
					->get();

			// check expiration of verify code
			if ( ! $verification) throw new \Exception('Verification Processing Failed');
			foreach ($verification as $obj) {
				$target_verification = $obj;
			}
			if (time() > $target_verification->expiration)
				throw new \Exception('Verification Processing Timeout');

			// save customer request
			$customer_request = \Model_Customer_Request::forge(array(
				'imei'   => \Input::post('imei'),
				'status' => 0 // Not yet request to an admin
			));
			if ( ! ($customer_request and $customer_request->save()))
				throw new \Exception('Verification Processing Failed');

			// remove verification record after confirm verify code successful
			if ( ! $verification = \Model_Verification::find($target_verification->id))
				throw new \Exception("Verification Processing Failed");
			$verification->delete();

			$instance->commit_transaction();
		}
		catch (\Exception $e)
		{
			$instance->rollback_transaction();
			return $this->error_response($e->getMessage());
		}

		return $this->success_response($customer_request);
	}

	/**
	 * The admin finding function.
	 *
	 * @access  public
	 * @return  Http code
	 */
	public function post_find_admin()
	{
		try
		{
			$val = \Model_Verification::validate('admin_verification');
			if ( ! $val->run()) throw new \Exception($this->response($val->error()));

			$admin_name = \Input::post('admin');
			$admin = \Model_User::query()
					->where('username', $admin_name)
					->from_cache(false)->get();

			if ( ! $admin) throw new \Exception('Admin '.$admin_name.' is not exist');
		}
		catch (\Exception $e)
		{
			return $this->error_response($e->getMessage());
		}

		return $this->success_response($admin);
	}

	/**
	 * The admin selection function.
	 *
	 * @access  public
	 * @return  Http code
	 */
	public function post_request_admin()
	{
		$instance = \Database_Connection::instance();
		$instance->start_transaction();

		try
		{
			$val = \Model_Customer_Request::validate('admin_request');
			if ( ! $val->run()) throw new \Exception($this->response($val->error()));

			$admin_id = \Input::post('admin_id');
			$customer_request_id = \Input::post('customer_request_id');
			if ( (! $admin = \Model_User::find($admin_id)) ||
				(! $customer_request = \Model_Customer_Request::find($customer_request_id)))
				throw new \Exception("Request To Admin Failed");

			// update admin id in customer request
			$customer_request->user_id = $admin_id;
			if ( ! ($customer_request and $customer_request->save()))
				throw new \Exception("Request To Admin Failed");

			$instance->commit_transaction();
		}
		catch (\Exception $e)
		{
			$instance->rollback_transaction();
			return $this->error_response($e->getMessage());
		}

		return $this->success_response();
	}
}
