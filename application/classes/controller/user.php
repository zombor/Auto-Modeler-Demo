<?php

class Controller_User extends Controller
{
	public function action_add()
	{
		$factory = new Context_User_Add_Factory;
		$view = new View_User_Add;
		if (HTTP_Request::POST == $this->request->method())
		{
			$factory->data($this->request->post());
			$result = $factory->fetch()->execute();

			if ($result['status'] == Context_User_Add::SUCCESS)
			{
				$this->request->redirect(Route::get('list users')->uri());
			}
			else if ($result['status'] == Context_User_Add::FAILURE)
			{
				$view->errors = $result['errors'];
			}
		}
		else
		{
			$view->groups = $factory->fetch()->groups();
			var_dump($view->groups);
		}

		$this->response->body($view);
	}

	public function action_list()
	{
		$view = new View_User_List;

		$factory = new Context_User_List_Factory;
		$result = $factory->fetch()->execute();
		$view->users = $result['users'];
		$this->response->body($view);
	}

	public function action_view()
	{
		$view = new View_User_View;

		$gateway = new AutoModeler_Gateway_Users(Database::instance());
		$user = $gateway->find_user($this->request->param('user_id'));
		$view->user = $user;
		$this->response->body($view);
	}
}
