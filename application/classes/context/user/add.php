<?php

class Context_User_Add
{
	const SUCCESS = 'success';
	const FAILURE = 'failure';

	public $gateway;

	public function __construct(array $data, Model_User $user = NULL)
	{
		$this->data = $data;
		if ( ! $user)
		{
			$user = new Model_User;
		}
		$this->user = $user;
		$this->user->data($data);
	}

	public function execute()
	{
		$valid = $this->user->valid();

		if ($valid === TRUE)
		{
			$user = $this->gateway()->create($this->user);
			return ['status' => self::SUCCESS, 'data_array' => $user->as_array()];
		}
		else
		{
			return ['status' => self::FAILURE, 'errors' => $valid['errors']];
		}
	}

	protected function gateway()
	{
		if ( ! $this->gateway)
		{
			return $this->gateway = new AutoModeler_Gateway_Users(Database::instance());
		}

		return $this->gateway;
	}
}
