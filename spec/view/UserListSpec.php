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
		$times = 5;
		$user_object = Mockery::mock('user');
		$iterator = array();
		for ($i = 0; $i < $times; $i++)
		{
			$user_object->shouldReceive('as_array')->andReturn(
				array(
					'id' => $i,
					'email' => $i.'@foo.com',
					'password' => 'test',
				)
			);
			$iterator[] = $user_object;
		}
		$this->subject->users = $iterator;

		$users = $this->subject->users();
		$this->spec(count($users))->should->equal($times);
	}
}
