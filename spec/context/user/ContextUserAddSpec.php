<?php

class DescribeContextUserAdd extends \PHPSpec\Context
{
	public function itHandlesSuccess()
	{
		$data = [
			'email' => 'foo@bar.com',
			'password' => 'qwerty',
			'first_name' => 'foo',
			'last_name' => 'bar',
			'middle_name' => 'f',
			'groups' => [1,2,3],
		];

		$user = Mockery::mock('Model_User');
		$errors = Mockery::mock('errors');
		$user->shouldReceive('valid')->andReturn(TRUE)->once();
		$user->shouldReceive('data')->with(
			[
				'email' => 'foo@bar.com',
				'password' => 'qwerty',
				'first_name' => 'foo',
				'last_name' => 'bar',
				'middle_name' => 'f',
			]
		)->once();
		$user->shouldReceive('as_array')->andReturn($data_array = []);

		$gateway = Mockery::mock('gateway');
		$gateway->shouldReceive('create')->with($user)->once()->andReturn($user);

		$context = new Context_User_Add($data, $user, $gateway);

		$result = $context->execute();
		$this->spec($result['status'])->should->equal(Context_User_Add::SUCCESS);
		$this->spec($result['data_array'])->should->equal($data_array);
	}

	public function itRetreivesGroupsToChooseFrom()
	{
		$data = [];
		$user = Mockery::mock('Model_User');
		$user->shouldReceive('data')->once();
		$user_gateway = Mockery::mock('user_gateway');
		$group_gateway = Mockery::mock('group_gateway');
		$group = Mockery::mock('group');
		$group->shouldReceive('as_array')->andReturn($data);
		$group_gateway->shouldReceive('find_groups')->andReturn(
			[
				$group,
				$group,
			]
		);

		$context = new Context_User_Add($data, $user, $user_gateway, $group_gateway);
		$groups = $context->groups();
		$this->spec($groups)->should->equal([$data, $data]);
	}

	public function itAssignsData()
	{
		$user = Mockery::mock('Model_User');
		$user->shouldReceive('data')->twice();
		$context = new Context_User_Add([], $user, Mockery::mock('gateway'));
		$data = ['name' => 'phpspec', 'password' => 'qwerty'];
		$context->data($data);

		$this->spec($context->data())->should->equal($data);
	}

	public function itHandlesInvalidData()
	{
		$data = [];
		$user = Mockery::mock('Model_User');
		$errors = Mockery::mock('errors');
		$user->shouldReceive('data');
		$user->shouldReceive('valid')->andReturn(
			[
				'status' => FALSE,
				'errors' => $errors,
			]
		);
		$context = new Context_User_Add($data, $user, Mockery::mock('gateway'));

		$result = $context->execute();
		$this->spec($result['status'])->should->equal(Context_User_Add::FAILURE);
		$this->spec($result['errors'])->should->equal($errors);
	}
}
