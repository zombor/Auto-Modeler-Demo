<?php

class Context_User_List_Factory
{
	public function fetch()
	{
		return new Context_User_List($this->gateway());
	}

	public function gateway()
	{
		return new AutoModeler_Gateway_Users(Database::instance());
	}
}
