<?php

class Context_User_Add
{
	const SUCCESS = 'success';
	const FAILURE = 'failure';

	protected $_group_gateway;
	protected $_user;

	public function __construct(array $data, Model_User $user, $user_gateway, $group_gateway)
	{
		$groups = arr::get($data, 'groups', array());
		unset($data['groups']);

		$user->create = function($data, $groups, $user_gateway, $group_gateway) use($user)
		{
			call_user_func($user->assign_data, $data);
			$user = $user_gateway->create($user);
			$group_gateway->assign_groups_to_user($user->id, $groups);

			return $user;
		};

		$user->assign_data = function(array $data) use($user)
		{
			$user->data(
				[
					'email' => arr::get($data, 'email'),
					'password' => arr::get($data, 'password'),
					'first_name' => arr::get($data, 'first_name'),
					'last_name' => arr::get($data, 'last_name'),
					'middle_name' => arr::get($data, 'middle_name'),
				]
			);
		};

		$this->_data = $data;
		$this->_user = $user;
		$this->_groups = $groups;
		$this->_user_gateway = $user_gateway;
		$this->_group_gateway = $group_gateway;
	}

	/*
	 * Starts the processing of this use case.
	 */
	public function execute()
	{
		try
		{
			$user = call_user_func($this->_user->create, $this->_data, $this->_groups, $this->_user_gateway, $this->_group_gateway);
			$status = ['status' => self::SUCCESS, 'data_array' => $user->as_array()];
		}
		catch (AutoModeler_Exception_Validation $e)
		{
			$status = ['status' => self::FAILURE, 'errors' => $e->as_array()];
		}

		return $status;
	}

	/*
	 * This is a helper method to assist in the request part of this use case.
	 * It is used before the use case is processed. Since this data is part
	 * of the use case, I feel it belongs here, and the user of this context
	 * can ask it for this data.
	 */
	public function groups()
	{
		$groups = $this->_group_gateway->find_groups();
		$array = [];

		foreach ($groups as $group)
		{
			$array[] = $group->as_array();
		}

		return $array;
	}

	/*
	 * Post-construct assignment of data. Defers to the role
	 */
	public function data(array $data)
	{
		call_user_func($this->_user->assign_data, $data);
	}
}
