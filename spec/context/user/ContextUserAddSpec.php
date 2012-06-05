<?php

class DescribeContextUserAdd extends \PHPSpec\Context
{
	public function before()
	{
		$this->valid_data = [
			'email' => 'foo@bar.com',
			'password' => 'qwerty',
			'first_name' => 'foo',
			'last_name' => 'bar',
			'middle_name' => 'f',
			'groups' => [1,2,3],
		];

		$this->user = Mockery::mock('Model_User');
		$this->user_gateway = Mockery::mock('gateway');
		$this->group_gateway = Mockery::mock('gateway');
	}

	public function itSavesAUser()
	{
		$errors = Mockery::mock('errors');
		$this->user->shouldReceive('valid')->andReturn(TRUE)->once();
		$this->user->shouldReceive('data')->with(
			[
				'email' => 'foo@bar.com',
				'password' => 'qwerty',
				'first_name' => 'foo',
				'last_name' => 'bar',
				'middle_name' => 'f',
			]
		)->once();
		$this->user->shouldReceive('as_array')->andReturn($data_array = []);

		$this->user_gateway->shouldReceive('create')->with($this->user)->once()->andReturn($this->user);

		$this->group_gateway->shouldReceive('assign_groups_to_user');

		$context = new Context_User_Add($this->valid_data, $this->user, $this->user_gateway, $this->group_gateway);

		$result = $context->execute();
		$this->spec($result['status'])->should->equal(Context_User_Add::SUCCESS);
		$this->spec($result['data_array'])->should->equal($data_array);
	}

	public function itSavesGroupsAssociatedWithTheUser()
	{
		$this->user->shouldReceive('valid')->andReturn(TRUE)->once();
		$this->user->shouldReceive('data');
		$this->user->shouldReceive('as_array')->andReturn($data_array = []);
		$this->user_gateway->shouldReceive('create')->andReturn($this->user);
		$this->group_gateway->shouldReceive('assign_groups_to_user')->once()->with('', [1,2,3]);

		$context = new Context_User_Add($this->valid_data, $this->user, $this->user_gateway, $this->group_gateway);

		$result = $context->execute();
	}

	public function itRetreivesGroupsToChooseFrom()
	{
		$data = [];
		$this->user->shouldReceive('data')->once();
		$group = Mockery::mock('group');
		$group->shouldReceive('as_array')->andReturn($data);
		$this->group_gateway->shouldReceive('find_groups')->andReturn(
			[
				$group,
				$group,
			]
		);

		$context = new Context_User_Add($data, $this->user, $this->user_gateway, $this->group_gateway);
		$groups = $context->groups();
		$this->spec($groups)->should->equal([$data, $data]);
	}

	public function itAssignsData()
	{
		$this->user->shouldReceive('data')->twice();
		$context = new Context_User_Add([], $this->user, Mockery::mock('gateway'), Mockery::mock('gateway'));
		$data = ['name' => 'phpspec', 'password' => 'qwerty'];
		$context->data($data);

		$this->spec($context->data())->should->equal($data);
	}

	public function itHandlesInvalidData()
	{
		$data = [];
		$errors = Mockery::mock('errors');
		$this->user->shouldReceive('data');
		$this->user->shouldReceive('valid')->andReturn(
			[
				'status' => FALSE,
				'errors' => $errors,
			]
		);
		$context = new Context_User_Add($data, $this->user, Mockery::mock('gateway'), Mockery::mock('gateway'));

		$result = $context->execute();
		$this->spec($result['status'])->should->equal(Context_User_Add::FAILURE);
		$this->spec($result['errors'])->should->equal($errors);
	}
}
