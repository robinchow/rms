<?php
class CampSettingsController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
        $this->beforeFilter('exec');
    }

    public function get_index()
    {
        $camps = CampSetting::All();
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
            $camp = CampSetting::create(Input::get());

            return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Added New Camp');
        }
        else
        {
            return Redirect::to('rms/camp/settings/add')
                ->withErrors($validation)
                ->withInput(); 
        }


    }

    public function get_show($id)
    {
        $camp = CampSetting::find($id);
        return View::make('camp.settings.show')->with('camp',$camp);
    }

    public function get_edit($id)
    {
        $years = Year::lists('year', 'id');
        $camp = CampSetting::find($id);
        return View::make('camp.settings.edit')
            ->with('camp',$camp)
            ->with('years',$years);
    }

    public function post_edit($id)
    {

        $input = Input::get();
        $input['visible'] = Input::get('visible', 0);

        $rules = array(
            'year_id'  => 'required|unique:camp_settings,year_id,'.$id,
            'places' => 'required|integer',
            'theme'  => 'required',
            'details'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            CampSetting::find($id)->update($input);

            return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Edited a Camp');
        }
        else
        {
            return Redirect::to('rms/camp/settings/edit/'.$id)
                ->withErrors($validation)
                ->withInput(); 
        }


    }


    public function get_delete($id)
    {
        $camp = Camp_setting::find($id)->delete();
        return Redirect::to('rms/camp/settings')
                ->with('success', 'Successfully Removed Camp');
    }
}
