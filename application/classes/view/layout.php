<?php

class View_Layout extends Kostache_Layout
{
	public function title()
	{
		return 'Kohana Demo Site';
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
