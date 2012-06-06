<?php

class Context_User_List
{
	const SUCCESS = 'success';

	protected $_gateway;

	public function __construct($gateway)
	{
		$this->_gateway = $gateway;
	}

	public function execute()
	{
		$users = $this->_gateway->find_users();

		$return = [];
		foreach($users as $user)
		{
			$return[] = $user;
		}

		return ['status' => self::SUCCESS, 'users' => $return];
	}
}
