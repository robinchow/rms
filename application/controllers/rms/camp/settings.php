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
        return View::make('camp.settings.index')->with('camps',$camps);
    }

    public function get_add()
    {
    	$years = Year::lists('year', 'id');
        return View::make('camp.settings.add')->with('years',$years);
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'year_id'  => 'required',
            'places' => 'required|integer',
            'theme'  => 'required',
            'details'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $camp = Camp_Setting::create(Input::get());

            return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Added New Camp');
        }
        else
        {
            return Redirect::to('rms/camp/settings/add')
                ->with_errors($validation)
                ->with_input(); 
        }


    }
}