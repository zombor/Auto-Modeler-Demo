<?php

class View_User_List extends KOstache
{
	public $users;

	public function users()
	{
		$users = array();
		foreach ($this->users as $user)
		{
			$users[] = $user->as_array();
		}

		return $users;
	}
}
