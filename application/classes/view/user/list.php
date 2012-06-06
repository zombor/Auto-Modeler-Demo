<?php

class View_User_List extends View_Layout
{
	public $users;

	public function users()
	{
		$users = array();
		foreach ($this->users as $user)
		{
			$users[] = [
				'id' => $user->id,
				'email' => $user->email,
				'name' => $user->name(),
			];
		}

		return $users;
	}
}
