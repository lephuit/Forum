<?php
class Controller_Reminder extends Controller_Base{

	public function action_index()
	{
		$data['reminders'] = Model_Reminder::find('all');
		$this->template->title = "Reminders";
		$this->template->content = View::forge('reminder/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('reminder');

		if ( ! $data['reminder'] = Model_Reminder::find($id))
		{
			Session::set_flash('error', 'Could not find reminder #'.$id);
			Response::redirect('reminder');
		}

		$this->template->title = "Reminder";
		$this->template->content = View::forge('reminder/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Reminder::validate('create');
			
			if ($val->run())
			{
				$reminder = Model_Reminder::forge(array(
					'name' =>  Auth::instance()->get_screen_name(),
					'message' => Input::post('message'),
					'time' => Input::post('time'),
				));

				if ($reminder and $reminder->save())
				{
					Session::set_flash('success', 'Added reminder #'.$reminder->id.'.');

					Response::redirect('reminder');
				}

				else
				{
					Session::set_flash('error', 'Could not save reminder.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Reminders";
		$this->template->content = View::forge('reminder/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('reminder');

		if ( ! $reminder = Model_Reminder::find($id))
		{
			Session::set_flash('error', 'Could not find reminder #'.$id);
			Response::redirect('reminder');
		}

		$val = Model_Reminder::validate('edit');

		if ($val->run())
		{
			$reminder->name = Auth::instance()->get_screen_name();
			$reminder->message = Input::post('message');
			$reminder->time = Input::post('time');

			if ($reminder->save())
			{
				Session::set_flash('success', 'Updated reminder #' . $id);

				Response::redirect('reminder');
			}

			else
			{
				Session::set_flash('error', 'Could not update reminder #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$reminder->name = $val->validated('name');
				$reminder->message = $val->validated('message');
				$reminder->time = $val->validated('time');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('reminder', $reminder, false);
		}

		$this->template->title = "Reminders";
		$this->template->content = View::forge('reminder/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('reminder');

		if ($reminder = Model_Reminder::find($id))
		{
			$reminder->delete();

			Session::set_flash('success', 'Deleted reminder #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete reminder #'.$id);
		}

		Response::redirect('reminder');

	}


}
