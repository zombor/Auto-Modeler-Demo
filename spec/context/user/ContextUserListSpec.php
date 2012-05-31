<?php

class DescribeContextUserList extends \PHPSpec\Context
{
	public function itFetchesAllUsers()
	{
		$gateway = Mockery::mock('gateway');
		$user = Mockery::mock('user');
		$user->shouldReceive('as_array')->andReturn($user_array = []);
		$gateway->shouldReceive('find_users')->once()->andReturn([$user, $user, $user]);
		$context = new Context_User_List($gateway);
		$result = $context->execute();

		$this->spec($result['status'])->should->equal(Context_User_List::SUCCESS);
		$this->spec($result['users'])->should->equal([$user_array, $user_array, $user_array]);
	}
}
