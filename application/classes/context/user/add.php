<?php

class Context_User_Add
{
	const SUCCESS = 'success';
	const FAILURE = 'failure';

	public $gateway;

	public function __construct(array $data, Model_User $user, $gateway)
	{
		$this->user = $user;
		$this->assign_data($data);
		$this->gateway = $gateway;
	}

	public function execute()
	{
		$valid = $this->user->valid();

		if ($valid === TRUE)
		{
			$user = $this->gateway->create($this->user);
			return ['status' => self::SUCCESS, 'data_array' => $user->as_array()];
		}
		else
		{
			return ['status' => self::FAILURE, 'errors' => $valid['errors']];
		}
	}

	public function data(array $data = NULL)
	{
		if ($data)
		{
			$this->assign_data($data);
		}

		return $this->data;
	}

	protected function assign_data(array $data)
	{
		$this->data = $data;
		$this->user->data($data);
	}
}
