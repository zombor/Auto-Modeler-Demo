<?php

class DescribeGroup extends \PHPSpec\Context
{
	public function before()
	{
		$this->subject = new Model_Group;
	}

	public function itHasTheCorrectFields()
	{
		$fields = $this->subject->as_array();
		$this->spec(array_key_exists('id', $fields))->shouldNot->beFalse();
		$this->spec(array_key_exists('name', $fields))->shouldNot->beFalse();
	}

	public function itRequiresName()
	{
		$rules = $this->subject->rules();
		$found = FALSE;
		foreach ($rules['name'] as $rule)
		{
			if ($rule == array('not_empty'))
				$found = TRUE;
		}

		$this->spec($found)->should->beTrue();
	}
}
