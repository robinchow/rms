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

}