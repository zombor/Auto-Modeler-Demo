<?php

class Context_User_Add_Factory
{
	protected $_data = [];

	public function __construct(array $data = [])
	{
		$this->_data = $data;
	}

	public function fetch()
	{
		return new Context_User_Add($this->_data, $this->user(), $this->gateway(), $this->group_gateway());
	}

	public function user()
	{
		return new Model_User;
	}

	public function gateway()
	{
		return new AutoModeler_Gateway_Users(
			Database::instance(),
			new Database_Query_Builder_Select,
			new Database_Query_Builder_Insert,
			new Database_Query_Builder_Update,
			new Database_Query_Builder_Delete
		);
	}

	public function group_gateway()
	{
		return new AutoModeler_Gateway_Groups(Database::instance());
	}
}
