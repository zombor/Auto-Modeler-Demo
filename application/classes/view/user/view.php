<?php

class View_User_View extends KOstache
{
	public $user;

	public function user()
	{
		return $this->user->as_array();
	}
}
