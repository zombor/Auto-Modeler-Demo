<?php

class AutoModeler_Gateway_Users extends Arden_Repository_KohanaDatabase
{
	protected $_model_class = 'Model_User';
	protected $_table_name = 'users';

	public function find_users()
	{
		return $this->load_set([]);
	}

	public function find_user($id)
	{
		return $this->load_object(['id' => $id]);
	}
}
