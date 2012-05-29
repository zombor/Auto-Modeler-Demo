<?php

class View_Layout extends Kostache_Layout
{
	protected $_partials = array(
		'menu' => 'partials/menu',
	);

	public function title()
	{
		return 'Kohana Demo Site';
	}

	/**
	 * This is a convoluted example to show how to do dynamic submenus.
	 */
	public function menu()
	{
		return array(
			array(
				'name' => 'users',
				'href' => '#',
				'submenu' => TRUE,
				'menu' => array(
					array(
						'name' => 'foo',
						'href' => '#',
						'submenu' => FALSE,
					),
					array(
						'name' => 'bar',
						'href' => '#',
						'submenu' => TRUE,
						'menu' => array(
							'name' => 'this is a third submenu',
							'href' => '#',
							'submenu' => FALSE,
						),
					)
				),
			),
			array(
				'name' => 'foobar',
				'href' => '#',
				'submenu' => FALSE,
			),
		);
	}

	public function stylesheets()
	{
		return array(
			array(
				'href' => 'assets/css/reset.css',
				'media' => 'all',
			),
		);
	}

	public function scripts()
	{
		return array(
			array(
				'src' => 'assets/scripts/jquery.js',
			)
		);
	}
}
