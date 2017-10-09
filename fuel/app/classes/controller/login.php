<?php

class Controller_Login extends Controller_Base
{
	/**
	 * Preprocessing
	 */
	public function before() {
		// Set fields handled in input form as array
		parent::before();

	}

	/**
	 * The login function
	 *
	 * @access  public
	 * @return  Response view
	 */
	public function action_index()
	{
		// Call view template
		$view = View::forge('login/index');

		return $view;
	}
}