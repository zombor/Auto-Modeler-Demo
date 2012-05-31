<?php

class DescribeUserList extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_User_List;
	}

	public function itHasALayout()
	{
		$this->spec($this->subject instanceof View_Layout)->should->beTrue();
	}

	public function itHasAnArrayOfUsers()
	{
		$users = [
			['id' => 1, 'email' => 'foo@bar.com', 'password' => 'qwerty'],
			['id' => 2, 'email' => 'foo2@bar.com', 'password' => 'qwerty'],
			['id' => 3, 'email' => 'foo3@bar.com', 'password' => 'qwerty'],
			['id' => 4, 'email' => 'foo4@bar.com', 'password' => 'qwerty'],
			['id' => 5, 'email' => 'foo5@bar.com', 'password' => 'qwerty'],
		];
		$expected = [
			['id' => 1, 'email' => 'foo@bar.com',],
			['id' => 2, 'email' => 'foo2@bar.com',],
			['id' => 3, 'email' => 'foo3@bar.com',],
			['id' => 4, 'email' => 'foo4@bar.com',],
			['id' => 5, 'email' => 'foo5@bar.com',],
		];
		$this->subject->users = $users;

		$users = $this->subject->users();
		$this->spec($users)->should->equal($expected);
		$this->spec(count($users))->should->equal(count($users));
	}
}
