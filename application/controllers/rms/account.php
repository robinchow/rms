<?php
class Rms_Account_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth')->except(array('login','signup','forgot','reset_password'));

        //Validator for old email and old pasword
        Validator::register('matches', function($attribute, $value, $parameters)
        {
            if($attribute =='old_password'){
                return Hash::check($value, Auth::user()->password);
            }

            if($attribute =='old_email'){
                return $value == Auth::user()->email;
            }
        });

        Validator::register('reset_password', function($attribute, $value, $parameters)
        {
            return (User::find($parameters[0])->reset_password_hash == $value);
        });
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
            // If user attempted to access specific URL before logging in
            if ( Session::has('pre_login_url') )
            {
                $url = Session::get('pre_login_url');
                Session::forget('pre_login_url');
                return Redirect::to($url);
            }
            else
            {
                return Redirect::to('rms/account');
            }
        }
        else
        {
            return Redirect::to('rms/account/login')
                ->with('warning', 'Email or Password incorrect.');
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
            'full_name' => 'required|max:128',
            'display_name' => 'alpha_dash|required|max:128|unique:profiles,display_name,' . $profile->id,
            'dob' => 'required',
            'gender' => 'required|in:O,M,F',
            'phone' => 'required|max:10',
            'university' => 'required',
            'program' => 'required',
            'start_year' => 'required',
            'image' => 'image',
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->passes())
        {
            Input::merge(array('privacy' => Input::get('privacy',0)));
            Input::merge(array('arc' => Input::get('arc',0)));

            //Update Profile
            if(Input::has_file('image')) {
                File::delete(path('base').'/public/img/profile/' . $profile->image);
                Input::upload('image', path('base').'/public/img/profile', Input::file('image.name'));
                Input::merge(array('image' => Input::file('image.name')));
            }

            Profile::update($profile->id,Input::get());


            return Redirect::to('rms/account')
                ->with('success', 'Profile successfully updated');
        }
        else 
        {
            return Redirect::to('rms/account/edit')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

    public function get_signup() 
    {
        return View::make('account.signup');
    }

    public function post_signup() 
    {

        $input = Input::all();

        $rules = array(
            'email'  => 'required|email|max:128|unique:users',
            'password' => 'required|max:128',
            'full_name' => 'required|max:128',
            'display_name' => 'required|alpha_dash|max:128|unique:profiles',
            'dob' => 'required',
            'gender' => 'required|in:O,M,F',
            'phone' => 'required|max:10',
            'university' => 'required',
            'program' => 'required',
            'start_year' => 'required',
            'image' => 'image',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            //Create Account
            $user = new User;
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            Auth::login($user->id);
            //Create Profile

            if(Input::has_file('image')) {
                Input::upload('image', path('base').'/public/img/profile', Input::file('image.name'));
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
        } else {
            return Redirect::to('rms/account/signup')
                ->with_errors($validation)
                ->with_input(); 
        }      

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

        if($user->needs_to_renew)
        {
            $user->years()->attach($year->id);

            return Redirect::to('rms/account')
                ->with('success', 'You succesfully renewed');
        }
        else 
        {
            return Redirect::to('rms/account')
                ->with('warning', 'You didn\'t need to renew');
        }
    }


    public function get_change_password()
    {
        return View::make('account.password');
    }

    public function post_change_password()
    {
        $input = Input::all();

        $rules = array(
            'password'  => 'required|max:128|confirmed|different:old_password',
            'old_password' => 'required|max:128|matches',
        );

        $messages = array(
            'old_password_matches' => 'The old password field must match your current password'
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->passes())
        {

            $user = Auth::user();
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            return Redirect::to('rms/account')
                ->with('success', 'Successfully changed Password');
        }
        else 
        {
            return Redirect::to('rms/account/change_password')
                ->with_errors($validation);
        }
    }

    public function get_change_email()
    {
        return View::make('account.email');
    }

    public function post_change_email()
    {
        $input = Input::all();

        $rules = array(
            'email'  => 'required|max:128|confirmed|different:old_email',
            'old_email' => 'required|max:128|matches',
        );

        $messages = array(
            'old_email_matches' => 'The old email field must match your current email'
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->passes())
        {
            $user = Auth::user();
            $user->email = Input::get('email');
            $user->save();

            return Redirect::to('rms/account')
                    ->with('success', 'Successfully Updated Email');
        }
        else 
        {
            return Redirect::to('rms/account/change_email')
                ->with_errors($validation)
                ->with_input(); 
        }
    }

    public function get_forgot()
    {
        return View::make('account.forgot');
    }

    public function post_forgot()
    {
        $email = Input::get('email');
        $user = User::where_email($email)->first();
        if($user) {
            $user->reset_password_hash = Str::random(64);
            $user->save();

            Message::to($user->email)
            ->from('webmin.head@cserevue.org.au', 'CSE Revue')
            ->subject('Reset Account Password')
            ->body('Hello,<br>You have requested a password reset click on the link to continue with the reset
                    <a href="'.$user->reset_url().'">Link</a> or copy and paste the url below in your browser<br>'.$user->reset_url())
            ->html(true)
            ->send();
            
            return Redirect::to('rms/account/login')
                ->with('success', 'Succesfully sent reset email');

        } else {
            return Redirect::to('rms/account/forgot')
                ->with('warning', 'Email does not exist, please enter correct email');
        }
    }

    public function get_reset_password($id, $reset_password_hash)
    {
        return View::make('account.reset')->with('id',$id)
        ->with('reset_password_hash', $reset_password_hash);
    }

    public function post_reset_password()
    {
        $input = Input::all();

        $rules = array(
            'id' => 'required',
            'password'  => 'required|max:128|confirmed',
            'reset_password_hash' => 'required|reset_password:'.Input::get('id'),
        );

        $messages = array(
            'reset_password_hash_reset_password' => 'The reset token is incorrect'
        );

        $validation = Validator::make($input, $rules, $messages);

        if ($validation->passes())
        {

            $user = User::find(Input::get('id'));
            $user->password = Hash::make(Input::get('password'));
            $user->reset_password_hash = '';
            $user->save();

            Auth::login(Input::get('id'));

            return Redirect::to('rms/account')
                ->with('success', 'Succesfully reset password');
        }
        else 
        {
            return Redirect::to('rms/account/reset_password/'. Input::get('id'). '/'. Input::get('reset_password_hash'))
                ->with_errors($validation);
        }

        return Redirect::to('rms/account');
    }

    public function get_logout()
    {
        Auth::logout();
        return Redirect::to('rms/account/login');
    }
}
