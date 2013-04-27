<?php
class Rms_Camp_Settings_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
    	$camps = Camp_Setting::All();
        return View::make('camp.settings.index');
    }
}