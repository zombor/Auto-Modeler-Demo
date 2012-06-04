<?php

class AutoModeler_Gateway_Groups extends AutoModeler_Gateway_Database
{
	protected $_model_name = 'Model_Group';
	protected $_table_name = 'groups';

	public function find_groups(Database_Query_Builder_Select $select = NULL)
	{
		return $this->_load_set($select);
	}

	public function find_group($id, Database_Query_Builder_Select $select = NULL)
	{
		if ($select === NULL)
		{
			$select = db::select();
		}

		$select->where('id', '=', $id);
		return $this->_load_object($select);
	}
}
