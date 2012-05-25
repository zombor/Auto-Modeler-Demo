<?php

class Controller_Welcome extends Controller
{
	public function action_index()
	{
		$this->response->body(new View_Welcome_Index);
	}
}
