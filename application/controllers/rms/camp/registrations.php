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
    	$camps = Camp_Setting::lists('theme', 'id');
        return View::make('camp.registrations.signup')->with('camps',$camps);
    }

    public function post_signup()
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
            $camp_reg = Camp_Registration::create(Input::get());

            return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Register for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/signup')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

}