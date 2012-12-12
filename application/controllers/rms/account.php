<?php
class Rms_Account_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth')->except(array('login'));
    }

    public function get_index()
    {
        $user = Auth::user();
        return View::make('account.index')->with('user', $user);
    }


    /**
     * Login Form
     */
    public function get_login()
    {
        return View::make('account.login');
    }
    
    /**
     * Login Post Handling
     */
    public function post_login()
    {
        $credentials = array(
            'username' => Input::get('email'),
            'password' => Input::get('password')
        );
        if ( Auth::attempt($credentials) )
        {
            return Redirect::to('rms/account');
        }
        else
        {
            return Redirect::to('rms/account/login')
                ->with('login_errors', true);
        }
    }

    public function get_edit() {
        $user = Auth::user();
        return View::make('account.edit')->with('user', $user);
    }

    public function post_edit() {
        $user = Auth::user();
        $profile = $user->profile;

        $profile->full_name    = Input::get('full_name');
        $profile->display_name    = Input::get('display_name');

        $profile->save();

        return Redirect::to('rms/account')
                ->with('status', 'Changes Successful');
    }



    public function get_logout()
    {
        Auth::logout();
        return Redirect::to('rms/account/login');
    }
}