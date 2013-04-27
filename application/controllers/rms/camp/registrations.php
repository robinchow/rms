<?php
class Rms_Camp_Registrations_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
    }

    public function get_signup()
    {
    	$camp = Camp_Setting::where('year_id', '=', Year::current_year()->id)->first();
        return View::make('camp.registrations.signup')->with('camp',$camp);
    }

    public function post_signup()
    {

        $input = Input::get();

        $rules = array(
            'user_id' => 'required|unique:camp_registrations',
            'camp_setting_id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $camp_reg = Camp_Registration::create(Input::get());

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Register for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/signup')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

    public function get_edit()
    {
        $camp = Camp_Setting::where('year_id', '=', Year::current_year()->id)->first();
        $user = Auth::user();
        $rego = Camp_Registration::where('camp_setting_id', '=',$camp->id)
            ->where('user_id', '=',$user->id)->first();
            
        return View::make('camp.registrations.edit')->with('rego',$rego);
    }

    public function post_edit()
    {
        $input = Input::get();

        $rules = array(
            'user_id' => 'required',
            'camp_setting_id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $camp_reg = Camp_Registration::update(Input::get('user_id'), Input::get());

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Edited registration for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/edit')
                ->with_errors($validation)
                ->with_input(); 
        }

    }

}