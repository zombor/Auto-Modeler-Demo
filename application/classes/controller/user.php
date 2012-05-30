<?php

class Controller_User extends Controller
{
	public function action_add()
	{
		$view = new View_User_Add;
		if (HTTP_Request::POST == $this->request->method())
		{
			$factory = new Context_User_Add_Factory($this->request->post());
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

		$this->response->body($view);
	}

	public function action_list()
	{
		$view = new View_User_List;

		$gateway = new AutoModeler_Gateway_Users(Database::instance());
		$view->users = $gateway->find_users();
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
