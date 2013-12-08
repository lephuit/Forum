<?php

class Controller_Users extends Controller_Base
{

	public function action_login()
        {
            $val = Validation::forge();
            $view = View::forge('users/login');
            $auth = Auth::instance();
         
           
            if (Input::post())
            {
                $val->add_field('username', 'Your username', 'required|min_length[3]|max_length[50]');
		$val->add_field('password', 'Your password', 'required|min_length[3]|max_length[50]');
    
                if ($val->run())
                {
                
                    if ($auth->login(Input::post('username'), Input::post('password')))
                    {                   $current_user = Model_User::find_by_username(Auth::get_screen_name());
					View::set_global('current_user', $current_user);
					View::set_global('logged_in', $current_user);
					Session::set_flash('Success', 'Logged in');
                                        Response::redirect('reminder/');
                    }
                    else
                    {
                        $view->login_error = 'Fail';
                    }
                }
               
            }
            $this->template->title = 'Login';
            $this->template->content = $view;
        }

        public function action_logout()
        {
            $auth = Auth::instance();
            $auth->logout();
            Session::set_flash('success', 'Logged out.');
            Response::redirect('reminder/');
        }
        
        
        public  function action_register()
        {
            $auth = Auth::instance();
            $view = View::forge('users/register');
            
           
            if (Input::post())
            {
                
                $username=INPUT::post('username');
                $email=INPUT::post('email');
                $password=INPUT::post('password');
                try
                {
                    $user = $auth->create_user($username, $password, $email);
                }
                catch (Exception $e)
                {
                    $error = $e->getMessage();
                }

                if (isset($user))
                {
                    $auth->login($username, $password);
                    
                }
                else
                {
                    if (isset($error))	
                               

				

                    {
                        $li = $error;
                    }
                    else
                    {
                        $li = 'Something went wrong with creating the user!';
                    }
                    $errors = Html::ul(array($li));
                    return array('e_found' => true, 'errors' => $errors);
                }
                
                
                
                
            }

            
            $this->template->title = 'User &raquo; Register';
            $this->template->content = $view;
        }
        
    public function action_recover($email, $forgot_rand)
        {
                $expire = date("U", strtotime('-2 hours'));
                $u = Model_User::query()->where('forgot_rand', $forgot_rand)->where('email', urldecode($email))->where('forgot_at', '>', $expire)->get();
                if ( $u ) $u = reset($u);
                if ( !isset($u->id) )
                {
                        Session::set_flash('error', 'Invalid request or password reset has expired.');
                        Response::redirect('users/forgot');
                }
                else
                {$form = Form::forge('login');
                        if ( $_POST && !empty($_POST['password']) )
                        {
                               
                                        $u->password = Auth::hash_password((string) Input::post('password'));
                                        $u->forgot_rand = '';
                                        $u->forgot_at = '';
                                        $u->save();
                                        Session::set_flash('success', 'Your new password has been set.');
                                        Response::redirect('users/recovered');
                                
                        }
                        else
                        {
                                $this->template->title = 'Recover Password';
                                $this->template->content = View::forge('users/recover');
                        } 
                }
        }


                public function action_recovered()
        {
                $this->template->title = 'Recovered';
                $this->template->content = View::forge('users/recovered');
        }


        
                public function action_check()
        {
                $username = html_entity_decode(Input::post('username'));

                $result = DB::select()->from('users')->where('username', '=', $username)->execute();
                if($result->count() > 0)
                  return false;
                else
                  return true;

        }
        
        
	public function action_forgot()
	{
            

	if ( $_POST )
	{
                $var=  \Fuel\Core\Validation::forge();
                $var->add_field('email', 'Email', 'valid_email');
                if($var->run()){
		$email = filter_var(Input::post('email'), FILTER_SANITIZE_EMAIL);
		$u = Model_User::query()->where('email', $email)->get();
		$id = reset($u)['id'];
               // die($id);
		if ( isset($u) && !empty($u) )
		{
			$user = Model_User::find($id);

			$rand = Str::random('unique');
			$link = Uri::base(false) .'users/recover/' .urlencode($email) .'/' .$rand;
			
                        $user->forgot_rand = $rand;
			$user->forgot_at = date("U");
			$user->save();
                        
                       
			$data['u'] = $user;
			$data['link'] = $link;
			$email = \Email::forge();
			$email->to($user->email, $user->username);
                      // die($data['link']);
			$email->subject('Password Recovery ');
			$email->html_body(\View::forge('users/recoverpassword', array('data'=>$data)));
			$email->from('smtp.mail.76@gmail.com', 'Reminder system');
			try
			{
				$email->send();
				// its been sent...
				Session::set_flash('success', 'Email sent to ' .$user->email .'. Password recovery links expire in 2 hours.');
				$this->template->title = 'Recovering Password';
				$this->template->content = View::forge('users/forgot');
			}
			catch(\EmailSendingFailedException $e)
			{
				die('Failed sending email.');
			}
			catch(\EmailValidationFailedException $e)
			{
				die('Email address failed to validate.');
			}
		}
		else // email not foundrecover
		{
			Session::set_flash('error', 'Can\'t find that email address.');
			Response::redirect('recover/forgot');
		}
                }
	}
	else
	{
		$this->template->title = 'Forgot password';
		$this->template->content = View::forge('users/forgot');
	}

    
            
	}
                 
}