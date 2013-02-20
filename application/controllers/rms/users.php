<?php
class Rms_Users_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except('index','show');

    }

    public function get_index()
    {
        $users = User::order_by('email', 'asc')->paginate(15);
        return View::make('users.index')->with('users', $users);
    }

    

    public function get_show($id)
    {
       $user = User::find($id);
        return View::make('users.show')->with('user', $user);
    }


    public function get_make_admin($user_id)
    {
        $user = User::find($user_id);
        $user->admin = true;
        $user->save();

        return Redirect::to('rms/users')
               ->with('status', 'Successful made the user an admin');
    }

    public function get_remove_admin($user_id)
    {
        $user = User::find($user_id);
        $user->admin = false;
        $user->save();

        return Redirect::to('rms/users')
               ->with('status', 'Successful made the user an admin');
    }

    
}
