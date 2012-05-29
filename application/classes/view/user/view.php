<?php

class View_User_View extends View_Layout
{
	public $user;

	public function user()
	{
		return $this->user->as_array();
	}
}
