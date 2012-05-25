<?php

class Controller_Welcome extends Controller
{
	public function action_index()
	{
		$view = new View_Welcome_Index;
		if (HTTP_Request::POST == $this->request->method())
		{
			$user = new Model_User;
			$user->data(
				array(
					'email' => $this->request->post('email'),
					'password' => $this->request->post('password'),
				)
			);
			$dao = AutoModeler_DAO_Database::factory(Database::instance(), 'users');

			try
			{
				$dao->create($user);
				$this->request->redirect('welcome/list');
			}
			catch (AutoModeler_Exception_Validation $e)
			{
				$view->errors = $e->as_array();
			}
		}

		$this->response->body($view);
	}
}
