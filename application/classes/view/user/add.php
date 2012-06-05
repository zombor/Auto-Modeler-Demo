<?php

class View_User_Add extends View_Layout
{
	public $errors = array();
	public $groups = array();

	public function has_errors()
	{
		return (bool) $this->errors();
	}

	public function errors()
	{
		$errors = array();
		foreach ($this->errors as $key => $error)
		{
			$errors[] = array('key' => $key, 'error' => $error);
		}

		return $errors;
	}

	public function email()
	{
		return array(
			'name' => 'email',
			'id' => 'email',
			'label' => 'Email',
			'has_error' => (bool) arr::get($this->errors, 'email'),
			'error' => arr::get($this->errors, 'email'),
		);
	}

	public function password()
	{
		return array(
			'name' => 'password',
			'id' => 'password',
			'label' => 'Password',
			'has_error' => (bool) arr::get($this->errors, 'password'),
			'error' => arr::get($this->errors, 'password'),
		);
	}

	public function first_name()
	{
		return array(
			'name' => 'first_name',
			'id' => 'first_name',
			'label' => 'First Name',
			'has_error' => (bool) arr::get($this->errors, 'first_name'),
			'error' => arr::get($this->errors, 'first_name'),
		);
	}

	public function last_name()
	{
		return array(
			'name' => 'last_name',
			'id' => 'last_name',
			'label' => 'Last Name',
			'has_error' => (bool) arr::get($this->errors, 'last_name'),
			'error' => arr::get($this->errors, 'last_name'),
		);
	}

	public function middle_name()
	{
		return array(
			'name' => 'middle_name',
			'id' => 'middle_name',
			'label' => 'Middle Name',
			'has_error' => (bool) arr::get($this->errors, 'middle_name'),
			'error' => arr::get($this->errors, 'middle_name'),
		);
	}

	public function groups()
	{
		$groups = [];
		foreach ($this->groups as $group)
		{
			$groups[] = ['id' => arr::get($group, 'id'), 'name' => arr::get($group, 'name')];
		}

		return $groups;
	}
}
