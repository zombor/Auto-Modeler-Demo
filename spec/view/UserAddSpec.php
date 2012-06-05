<?php

class DescribeUserAdd extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_User_Add;
	}

	public function itHasALayout()
	{
		$this->spec($this->subject instanceof View_Layout)->should->beTrue();
	}

	public function itHasAnEmailField()
	{
		$field = $this->subject->email();
		$this->spec($field['name'])->should->equal('email');
		$this->spec($field['id'])->should->equal('email');
		$this->spec($field['label'])->should->equal('Email');
	}

	public function itHasAnPasswordField()
	{
		$field = $this->subject->password();
		$this->spec($field['name'])->should->equal('password');
		$this->spec($field['id'])->should->equal('password');
		$this->spec($field['label'])->should->equal('Password');
	}

	public function itHasAFirstNameField()
	{
		$field = $this->subject->first_name();
		$this->spec($field['name'])->should->equal('first_name');
		$this->spec($field['id'])->should->equal('first_name');
		$this->spec($field['label'])->should->equal('First Name');
	}

	public function itHasALastNameField()
	{
		$field = $this->subject->last_name();
		$this->spec($field['name'])->should->equal('last_name');
		$this->spec($field['id'])->should->equal('last_name');
		$this->spec($field['label'])->should->equal('Last Name');
	}

	public function itHasAMiddleNameField()
	{
		$field = $this->subject->middle_name();
		$this->spec($field['name'])->should->equal('middle_name');
		$this->spec($field['id'])->should->equal('middle_name');
		$this->spec($field['label'])->should->equal('Middle Name');
	}

	public function itAcceptsAnErrorArray()
	{
		$errors = array('email' => 'Email error', 'password' => 'Password error');
		$this->subject->errors = $errors;
		$this->spec($this->subject->errors())->should->equal(
			array(
				array('key' => 'email', 'error' => 'Email error'),
				array('key' => 'password', 'error' => 'Password error'),
			)
		);
	}

	public function itKnowsWhenThereIsAnError()
	{
		$errors = array('email' => 'Email error', 'password' => 'Password error');
		$this->subject->errors = $errors;
		$this->spec($this->subject->has_errors())->should->beTrue();
	}

	public function itHighlightsTheEmailFieldForEmailError()
	{
		$errors = array('email' => 'Email error');
		$this->subject->errors = $errors;
		$email_field = $this->subject->email();
		$this->spec($email_field['has_error'])->should->beTrue();
		$this->spec($email_field['error'])->should->equal('Email error');
	}

	public function itHighlightsThePasswordFieldForPasswordError()
	{
		$errors = array('password' => 'Password error');
		$this->subject->errors = $errors;
		$password_field = $this->subject->password();
		$this->spec($password_field['has_error'])->should->beTrue();
		$this->spec($password_field['error'])->should->equal('Password error');
	}

	public function itHighlightsTheFirstNameFieldForFirstNameError()
	{
		$errors = array('first_name' => 'First Name error');
		$this->subject->errors = $errors;
		$first_name_field = $this->subject->first_name();
		$this->spec($first_name_field['has_error'])->should->beTrue();
		$this->spec($first_name_field['error'])->should->equal('First Name error');
	}

	public function itHighlightsTheLastNameFieldForLastNameError()
	{
		$errors = array('last_name' => 'Last Name error');
		$this->subject->errors = $errors;
		$last_name_field = $this->subject->last_name();
		$this->spec($last_name_field['has_error'])->should->beTrue();
		$this->spec($last_name_field['error'])->should->equal('Last Name error');
	}

	public function itHighlightsTheMiddleNameFieldForMiddleNameError()
	{
		$errors = array('middle_name' => 'Middle Name error');
		$this->subject->errors = $errors;
		$middle_name_field = $this->subject->middle_name();
		$this->spec($middle_name_field['has_error'])->should->beTrue();
		$this->spec($middle_name_field['error'])->should->equal('Middle Name error');
	}

	public function itHasGroups()
	{
		$this->subject->groups = [
			['id' => 1, 'name' => 'admin'],
			['id' => 2, 'name' => 'user'],
			];

		$this->spec($this->subject->groups())->should->equal(
			[
				['id' => 1, 'name' => 'admin'],
				['id' => 2, 'name' => 'user'],
			]
		);
	}

	public function itHandlesPoorlyFormattedGroups()
	{
		$this->subject->groups = [
			['name' => 'admin'],
		];

		$this->spec($this->subject->groups())->should->equal(
			[
				['id' => NULL, 'name' => 'admin'],
			]
		);
	}
}
