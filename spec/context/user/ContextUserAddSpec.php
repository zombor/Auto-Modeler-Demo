<?php

class DescribeContextUserAdd extends \PHPSpec\Context
{
	public function itHandlesSuccess()
	{
		$data = [];
		$user = Mockery::mock('Model_User');
		$errors = Mockery::mock('errors');
		$user->shouldReceive('valid')->andReturn(TRUE)->once();
		$user->shouldReceive('data')->once();
		$user->shouldReceive('as_array')->andReturn($data_array = []);

		$gateway = Mockery::mock('gateway');
		$gateway->shouldReceive('create')->with($user)->once()->andReturn($user);

		$context = new Context_User_Add($data, $user, $gateway);

		$result = $context->execute();
		$this->spec($result['status'])->should->equal(Context_User_Add::SUCCESS);
		$this->spec($result['data_array'])->should->equal($data_array);
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
