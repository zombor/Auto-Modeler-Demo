<?php

class Model_User extends AutoModeler_Model
{
	protected $_data = array(
		'id' => NULL,
		'email' => NULL,
		'password' => NULL,
	);

	protected $_rules = array(
		'email' => array(
			array('not_empty'),
			array('email'),
		),
		'password' => array(
			array('not_empty'),
		),
	);
}
