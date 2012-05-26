<?php

class Controller_User extends Controller
{
	public function action_add()
	{
		$view = new View_User_Add;
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
				$this->request->redirect('user/list');
			}
			catch (AutoModeler_Exception_Validation $e)
			{
				$view->errors = $e->as_array();
			}
		}

		$this->response->body($view);
	}

	public function action_list()
	{
		$view = new View_User_List;

	}
}
