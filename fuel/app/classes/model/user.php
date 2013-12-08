<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username' => array(
			'label' => 'Username',
			'validation' => array(
				'required', 
				'min_length' => array(3), 
				'max_length' => array(20),
				'username', # Validate if username only contains alphanum and/or underscores
				'unique' => array('users.username'), # Make sure the username has not been taken.
			)
		),
		'password' => array(
			'validation'  => array(
				'required', 
				'min_length' => array(5)
			)
		),
		
		'group',
		'email' => array(
			'label' => 'Email',
			'validation' => array(
				'required',
				'valid_email',
				'unique' => array('users.email'),
				'max_length' => array(45),
			)
		),
		'last_login',
		'login_hash',
		'profile_fields',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		# Make the Validation observer hook into these events
		# This ensures that even if you try to perform CRUD on this model
		# outside of a Fieldset form - for example an API call, it always validates
		'Orm\\Observer_Validation' => array(
			'events' => array('before_insert', 'before_update', 'before_save'),
		),
		'Orm\\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
		'Orm\\Observer_User',
	);

 public static  function validate_registration( $auth)
        {
            $val = Validation::forge();
            $val->add_model('Model_User');
           
           // $val->add_field('username', 'Your name', 'required|min_length[3]|max_length[50]|unique(users.username)');
	   // $val->add_field('email', 'Your email', 'required|valid_email|max_length[255]|unique(users.email)');
	    //$val->add_field('password', 'Your password', 'required|min_length[3]|max_length[255]');
	    $val->add_field('password_confirm', 'Confirm password', 'required|match_field[password]|min_length[3]|max_length[255]');
            $val->set_message('required', 'Yout :field can not be Blank.');
            $val->set_message('valid_email', 'The :field must be an email address');
            $val->set_message('match_field', 'The passwords do not match');
            $val->set_message('unique', ' This :field is not available.');
            
            
            if ($val->run())
            {
                $username = $val->validated('username');
                $password = $val->validated('password');
                $email = $val->validated('email');
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
            else
            {
                $errors = $val->show_errors();
                return array('e_found' => true, 'errors' => $errors);
            }
        }
	protected static $_table_name = 'users';

}
