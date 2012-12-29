<?php
class Rms_Account_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth')->except(array('login','signup'));
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

    public function get_edit() 
    {
        $user = Auth::user();
        return View::make('account.edit')->with('user', $user);
    }

    // POST /rms/account/edit
    public function post_edit() 
    {
        $user = Auth::user();
        $profile = $user->profile;

        //Validate Input have to validate the image still
        $rules = array(
            'full_name'  => 'required|max:128',
            'display_name' => 'alpha_dash|required|max:128|unique:profiles,display_name,' . $profile->id,
            'gender' => 'required|in:O,M,F',
            'dob' => 'required',
        );

        $validation = Validator::make(Input::all(), $rules);

        if (!$validation->fails())
        {
            //Update Profile
            if(Input::has_file('image')) {
                File::delete(path('base').'/public/img/profile/' . $profile->image);
                Input::upload('image', path('base').'/public/img/profile',Input::file('image.name'));
                Input::merge(array('image' => Input::file('image.name')));
            }

            Profile::update($profile->id,Input::get());


            return Redirect::to('rms/account')
                ->with('status', 'Changes Successful');
        }
        else 
        {
            return $validation->errors;
        }


    }

    public function get_signup() 
    {
        return View::make('account.signup');
    }

    public function post_signup() 
    {
        //should do validation first
        
        //Create Account
        $user = new User;
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->save();

        Auth::login($user->id);
        //Create Profile

        if(Input::has_file('image')) {
            Input::upload('image', path('base').'/public/img/profile',Input::file('image.name'));
            Input::merge(array('image' => Input::file('image.name')));
        }

        $profile_data = Input::get();
        unset($profile_data['email']);
        unset($profile_data['password']);


        $profile = new Profile($profile_data);

        $user->profile()->insert($profile);
        $user->save();


        //Automatic renew them for current year
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
        $user->years()->attach($year->id);


        return Redirect::to('rms/account')->with('status', 'Succesfully signed up');

    }


    public function get_renew()
    {
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
        
        return View::make('account.renew')
            ->with('year', $year);
    }

    public function post_renew() 
    {
        $user = Auth::user();
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
        $user->years()->attach($year->id);

        return Redirect::to('rms/account')
                ->with('status', 'Changes Successful');
    }

    public function get_logout()
    {
        Auth::logout();
        return Redirect::to('rms/account/login');
    }
}