<?php

class DescribeUserView extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new View_User_View;
	}

	public function itKnowsAboutTheUser()
	{
		$user = Mockery::mock();
		$user->shouldReceive('as_array')->andReturn($array = array('id' => 1, 'email' => 'foo@bar.com', 'password' => 'foobar'));

		$this->subject->user = $user;
		$this->spec($this->subject->user())->should->equal(
			$array
		);
	}
}
