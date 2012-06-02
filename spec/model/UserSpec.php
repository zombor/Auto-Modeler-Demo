<?php

class DescribeUser extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new Model_User;
	}

	public function itHasTheCorrectFields()
	{
		$fields = $this->subject->as_array();
		$this->spec(array_key_exists('id', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('email', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('password', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('first_name', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('last_name', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('middle_name', $fields))->shouldNot->beFalse();
	}

	public function itRequiresEmail()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['email'] as $rule)
		{
			if ($rule == array('not_empty'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}

	public function itRequiresValidEmail()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['email'] as $rule)
		{
			if ($rule == array('email'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}

	public function itRequiresPassword()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['password'] as $rule)
		{
			if ($rule == array('not_empty'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}

	public function itRequiresFirstName()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['first_name'] as $rule)
		{
			if ($rule == array('not_empty'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}

	public function itRequiresLastName()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['last_name'] as $rule)
		{
			if ($rule == array('not_empty'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}
}
