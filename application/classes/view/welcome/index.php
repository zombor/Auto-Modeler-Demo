<?php

class View_Welcome_Index extends KOstache
{
	public $errors = array();

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
}
