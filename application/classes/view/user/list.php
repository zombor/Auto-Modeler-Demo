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
				'id' => arr::get($user, 'id'),
				'email' => arr::get($user, 'email'),
			];
		}

		return $users;
	}
}
