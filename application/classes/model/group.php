<?php

class Model_Group extends AutoModeler_Model
{
	protected $_data = array(
		'id' => NULL,
		'name' => NULL,
	);

	protected $_rules = array(
		'name' => array(
			array('not_empty'),
		),
	);
}
