<?php

class Model_User extends AutoModeler_Model
{
	protected $_data = array(
		'id' => NULL,
		'email' => NULL,
		'password' => NULL,
		'first_name' => NULL,
		'last_name' => NULL,
		'middle_name' => NULL,
	);

	protected $_rules = array(
		'email' => array(
			array('not_empty'),
			array('email'),
		),
		'first_name' => array(
			array('not_empty'),
		),
		'last_name' => array(
			array('not_empty'),
		),
		'password' => array(
			array('not_empty'),
		),
	);
}
