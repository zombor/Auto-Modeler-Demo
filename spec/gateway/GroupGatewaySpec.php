<?php

class DescribeGroupGateway extends \PHPSpec\Context
{
	public function beforeAll()
	{
		$this->db = Mockery::mock('Database');
		$this->db->shouldReceive('disconnect');
	}

	public function before()
	{
		$this->subject = new AutoModeler_Gateway_Groups($this->db);
	}

	public function after()
	{
		\Mockery::close();
	}

	public function itFindsAllGroups()
	{
		$select = Mockery::mock('Database_Query_Builder_Select');

		// These assert that we have the correct table and model name set on the gateway
		$select->shouldReceive('from')->with('groups');
		$select->shouldReceive('as_object')->with('Model_Group');

		// We don't care what the return value is, we trust that database works correctly
		$select->shouldReceive('execute')->with($this->db)->andReturn($return_value = array());
		$result = $this->subject->find_groups($select);

		$this->spec($result)->should->equal($return_value);
	}

	public function itFindsASingleGroup()
	{
		$select = Mockery::mock('Database_Query_Builder_Select[where,from,execute]');

		$id = 1;
		$group = Mockery::mock('foo');
		$db_iterator = Mockery::mock('db_iterator');
		$db_iterator->shouldReceive('count')->andReturn(1);
		$db_iterator->shouldReceive('current')->andReturn(array('id' => $id, 'email' => 'foo@bar.com', 'password' => 'foobar'));

		$select->shouldReceive('where');
		$select->shouldReceive('execute')->with($this->db)->andReturn($db_iterator);
		$select->shouldReceive('from')->with('groups');

		$result = $this->subject->find_group($id, $select);
		$this->spec($result)->should->beAnInstanceOf('Model_Group');
		$this->spec($result->state())->should->equal(AutoModeler_Model::STATE_LOADED);
	}

	public function itSavesGroupsForAUser()
	{
		$insert = Mockery::mock('Database_Query_Builder_Insert');
		$insert->shouldReceive('values')->with($groups = [1,2,3])->once();
		$insert->shouldReceive('execute')->with($this->db)->once();
		$result = $this->subject->assign_groups_to_user(1, $groups, $insert);
	}

	public function itSavesNothingWhenSavingGroupsButPassedNoGroupIDs()
	{
		$insert = Mockery::mock('Database_Query_Builder_Insert');
		$result = $this->subject->assign_groups_to_user(1, array(), $insert);
	}
}
