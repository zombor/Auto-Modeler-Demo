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
		$user1 = new Model_User;
		$user1->data(['id' => 1, 'email' => 'foo@bar.com', 'password' => 'qwerty', 'first_name' => 'foo', 'last_name' => 'bar']);
		$user2 = new Model_User;
		$user2->data(['id' => 2, 'email' => 'foo2@bar.com', 'password' => 'qwerty', 'first_name' => 'foo2', 'last_name' => 'bar']);
		$user3 = new Model_User;
		$user3->data(['id' => 3, 'email' => 'foo3@bar.com', 'password' => 'qwerty', 'first_name' => 'foo3', 'last_name' => 'bar']);

		$users = [$user1, $user2, $user3];
		$expected = [
			['id' => 1, 'email' => 'foo@bar.com', 'name' => 'foo bar'],
			['id' => 2, 'email' => 'foo2@bar.com', 'name' => 'foo2 bar'],
			['id' => 3, 'email' => 'foo3@bar.com', 'name' => 'foo3 bar'],
		];
		$this->subject->users = $users;

		$users = $this->subject->users();
		$this->spec($users)->should->equal($expected);
		$this->spec(count($users))->should->equal(count($users));
	}
}
