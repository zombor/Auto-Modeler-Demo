<?php

class DescribeUserGateway extends \PHPSpec\Context
{
	public function before()
	{
		$this->db = Mockery::mock('alias:Database');
		$this->subject = new AutoModeler_Gateway_Users($this->db);
	}

	public function itFindsAllUsers()
	{
		$select = Mockery::mock('alias:Database_Query_Builder_Select');

		// These assert that we have the correct table and model name set on the gateway
		$select->shouldReceive('from')->with('users');
		$select->shouldReceive('as_object')->with('Model_User');

		// We don't care what the return value is, we trust that database works correctly
		$select->shouldReceive('execute')->with($this->db)->andReturn($return_value = array());
		$result = $this->subject->find_users($select);

		$this->spec($result)->should->equal($return_value);
	}
}
