<?php

class DescribeUserAddFactory extends \PHPSpec\Context
{
	public function itCreatesAUserAddContext()
	{
		$data = [];
		$factory = Mockery::mock('Context_User_Add_Factory[user,gateway,group_gateway]');
		$user = Mockery::mock('Model_User');
		$user->shouldReceive('data')->andReturn([]);
		$factory->shouldReceive('user')->andReturn($user)->once();
		$factory->shouldReceive('gateway')->andReturn(Mockery::mock('gateway'))->once();
		$factory->shouldReceive('group_gateway')->andReturn(Mockery::mock('group_gateway'))->once();
		$context = $factory->fetch();

		$this->spec($context)->should->beAnInstanceOf('Context_User_Add');
	}
}
