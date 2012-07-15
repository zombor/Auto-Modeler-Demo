<?php

class DescribeUserGateway extends \PHPSpec\Context
{
	public function beforeAll()
	{
		$this->db = Mockery::mock('Database');
		$this->db->shouldReceive('disconnect');
	}

	public function before()
	{
		$this->subject = new AutoModeler_Gateway_Users($this->db);
	}

	public function after()
	{
		\Mockery::close();
	}

	public function itFindsAllUsers()
	{
		$select = Mockery::mock('Database_Query_Builder_Select');

		// These assert that we have the correct table and model name set on the gateway
		$select->shouldReceive('from')->with('users');
		$select->shouldReceive('as_object')->with('Model_User');
		$select->shouldReceive('where')->with('active', '=', TRUE)->once();

		// We don't care what the return value is, we trust that database works correctly
		$select->shouldReceive('execute')->with($this->db)->andReturn($return_value = array());
		$result = $this->subject->find_users($select);

		$this->spec($result)->should->equal($return_value);
	}

	public function itFindsASingleUser()
	{
		$select = Mockery::mock('Database_Query_Builder_Select[where,from,execute]');

		$id = 1;
		$user = Mockery::mock('foo');
		$db_iterator = Mockery::mock('db_iterator');
		$db_iterator->shouldReceive('count')->andReturn(1);
		$db_iterator->shouldReceive('current')->andReturn(array('id' => $id, 'email' => 'foo@bar.com', 'password' => 'foobar'));

		$select->shouldReceive('where');
		$select->shouldReceive('execute')->with($this->db)->andReturn($db_iterator);
		$select->shouldReceive('from')->with('users');

		$result = $this->subject->find_user($id, $select);
		$this->spec($result)->should->beAnInstanceOf('Model_User');
		$this->spec($result->state())->should->equal(AutoModeler_Model::STATE_LOADED);
	}
}
