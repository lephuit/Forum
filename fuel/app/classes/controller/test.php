<?php

class Controller_Test extends Controller_Rest {
    
    public function action_check()
    {
        echo 'check';
        // pull the username from the post data
        $username = html_entity_decode(Input::post('username'));
        

        // check if the login/password is valid
        $auth = Auth::instance();
        $result = DB::select()->from('users')->where('username', '=', $username)->execute();
        if($result->count() > 0)
        {
            // username/password is valid
            $this->response(array('valid' => true, 'redirect' => '/'), 200);
        }
        else
        {
            // username/password is not valid, lets also add a little error message
            $this->response(array('valid' => false, 'error' => 'Invalid user name or password, please try again'), 200);
        }
    }
}

/* End of file q_auth.php */