<?php

class View_Welcome_Index extends KOstache
{
	public function email()
	{
		return array(
			'name' => 'email',
			'id' => 'email',
			'label' => 'Email',
		);
	}

	public function password()
	{
		return array(
			'name' => 'password',
			'id' => 'password',
			'label' => 'Password',
		);
	}
}
