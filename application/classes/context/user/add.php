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

		// Normally, UnsavedUser would be a private class of this context,
		// but you can't nest classes in php. This hard dependancy is ok in
		// this situation because of these facts. The role should be hidden
		// from the outside world.
		$this->_user = new UnsavedUser($user, $data, $groups, $user_gateway, $group_gateway);

		$this->_group_gateway = $group_gateway;
	}

	/*
	 * Starts the processing of this use case.
	 */
	public function execute()
	{
		try
		{
			$user = $this->_user->create();
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
		$this->_user->assign_data($data);
	}
}

/**
 * This is a role class, used to decorate the user model to behave in this use case
 */
class UnsavedUser
{
	protected $_user;
	protected $_data;
	protected $_groups;

	protected $_user_gateway;
	protected $_group_gateway;

	public function __construct(Model_User $user, array $data, array $groups, $user_gateway, $group_gateway)
	{
		$this->_user = $user;
		$this->_data = $data;
		$this->_user->data($data);
		$this->_groups = $groups;

		$this->_user_gateway = $user_gateway;
		$this->_group_gateway = $group_gateway;
	}

	public function create()
	{
		$user = $this->_user_gateway->create($this->_user);
		$this->_group_gateway->assign_groups_to_user($user->id, $this->_groups);

		return $user;
	}

	public function assign_data(array $data)
	{
		$this->data = $data;
		$this->_user->data(
			[
				'email' => arr::get($data, 'email'),
				'password' => arr::get($data, 'password'),
				'first_name' => arr::get($data, 'first_name'),
				'last_name' => arr::get($data, 'last_name'),
				'middle_name' => arr::get($data, 'middle_name'),
			]
		);
	}
}
