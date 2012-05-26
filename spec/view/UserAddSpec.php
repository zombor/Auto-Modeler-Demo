<?php

class DescribeUserAdd extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_User_Add;
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
}
