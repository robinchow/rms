<?php
class Rms_Users_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index','show','search'));

    }

    public function get_index()
    {
        $users = User::order_by('email', 'asc')->paginate(10);
        return View::make('users.index')->with('users', $users);
    }

    public function get_search($format = '.html')
    {
        $input = Input::get();
        if (array_key_exists('q', $input) && $input['q'] != '') {
            $query = $input['q'];
            if (strlen($query) > 8) {
                $phone_query = $query;
            } else {
                $phone_query = 'NOTAPHONENUMBER';
            }
            if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $query)) {
                $email_query = $query;
            } else {
                $email_query = 'NOTANEMAILADDRESS';
            }
            $results = User::join('profiles', 'users.id', '=', 'profiles.user_id')
                ->where('full_name','LIKE','%'.$query.'%')
                ->or_where('display_name','LIKE','%'.$query.'%')
                ->or_where('email','LIKE','%'.$email_query.'%')
                ->or_where('phone','LIKE','%'.$phone_query.'%')
                ->get();
        } else {
            $query = '';
            $results = array();
        }

        switch($format) {
            case '.csv': return View::make('users.search_csv')
                ->with('results',$results);
            default: return View::make('users.search')
                ->with('query', $query)
                ->with('results', $results);
        }
        
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
