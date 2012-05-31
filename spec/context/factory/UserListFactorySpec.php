<?php

class DescribeUserListFactory extends \PHPSpec\Context
{
	public function itCreatesAUserListContext()
	{
		$factory = Mockery::mock('Context_User_List_Factory[gateway]');
		$factory->shouldReceive('gateway')->andReturn(Mockery::mock('gateway'))->once();
		$context = $factory->fetch();

		$this->spec($context)->should->beAnInstanceOf('Context_User_List');
	}
}
