<?php

class Minion_Task_User_Create extends Minion_Task
{
	protected $_context;

	public function __construct()
	{
		$factory = new Context_User_Add_Factory;
		$this->_context = $factory->fetch();
	}

	public function execute(array $config)
	{
		$email = Minion_CLI::read('Enter the user\'s email');
		$password = Minion_CLI::read('Enter the user\'s password');
		$first_name = Minion_CLI::read('Enter the user\'s first name');
		$last_name = Minion_CLI::read('Enter the user\'s last name');

		$groups = Minion_CLI::read('Enter zero or more ids for groups for the user ['.implode(', ',$this->_format_groups()).']');

		$this->_context->data([
			'email' => $email,
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'groups' => $this->_find_group_ids($groups),
		]);

		$result = $this->_context->execute();
		var_dump($result);
	}

	protected function _format_groups()
	{
		$groups = [];
		foreach ($this->_context->groups() as $group)
		{
			$groups[] = $group['name'];
		}

		return $groups;
	}

	protected function _find_group_ids($group_names)
	{
		$group_ids = [];
		$group_names = explode(',', $group_names);
		array_walk($group_names, 'trim');
		foreach ($this->_context->groups() as $group)
		{
			if (in_array($group['name'], $group_names))
			{
				$group_ids[] = $group['id'];
			}
		}

		return $group_ids;
	}
}
