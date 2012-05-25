<?php

class DescribeWelcomeIndex extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_Welcome_Index;
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
}
