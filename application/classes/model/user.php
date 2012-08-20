<?php

class Model_User
{
	public $id;
	public $email;
	public $password;
	public $first_name;
	public $last_name;
	public $middle_name;

	public function name()
	{
		return $this->first_name.' '.$this->last_name;
	}
}
