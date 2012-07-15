<?php

class AutoModeler_Gateway_Users extends AutoModeler_Repository_Database
{
	protected $_model_name = 'Model_User';
	protected $_table_name = 'users';

	public function find_users(Database_Query_Builder_Select $select = NULL)
	{
		$select->where('active', '=', TRUE);
		return $this->_load_set($select);
	}

	public function find_user($id, Database_Query_Builder_Select $select = NULL)
	{
		if ($select === NULL)
		{
			$select = db::select();
		}

		$select->where('id', '=', $id);
		return $this->_load_object($select);
	}
}
