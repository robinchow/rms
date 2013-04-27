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
            'year_id'  => 'required|unique:camp_settings',
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

    public function get_show($id)
    {
    	$camp = Camp_Setting::find($id);
        return View::make('camp.settings.show')->with('camp',$camp);
    }

    public function get_edit($id)
    {
    	$years = Year::lists('year', 'id');
    	$camp = Camp_Setting::find($id);
        return View::make('camp.settings.edit')
        	->with('camp',$camp)
        	->with('years',$years);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'year_id'  => 'required|unique:camp_settings',
            'places' => 'required|integer',
            'theme'  => 'required',
            'details'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $camp = Camp_Setting::update($id,Input::get());

            return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Edited a Camp');
        }
        else
        {
            return Redirect::to('rms/camp/settings/edit')
                ->with_errors($validation)
                ->with_input(); 
        }


    }


    public function get_delete($id)
    {
        $camp = Camp_setting::find($id)->delete();
        return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Removed Camp');
    }
}