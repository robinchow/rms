<?php
class Rms_Years_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index'));

    }

    public function get_index()
    {
        $years = Year::all();
        return View::make('years.index')->with('years', $years);
    }

    public function get_show($id)
    {
        $year = Year::find($id);
        return View::make('years.show')->with('year',$year);
    }


    public function get_add()
    {
        return View::make('years.add');
    }

    public function post_add()
    {

        $years = Year::create(Input::get());

        return Redirect::to('rms/years')
                ->with('status', 'Successful Added New Year');
    }

    public function get_edit($id)
    {
        $year = Year::find($id);
        return View::make('years.edit')->with('year',$year);
    }

    public function post_edit($id)
    {

        $year = Year::update($id, Input::get());

        return Redirect::to('rms/years')
                ->with('status', 'Successful Edited Year');
    }

    public function get_delete($id)
    {
        $year = Year::find($id)->delete();
        return Redirect::to('rms/years')
                ->with('status', 'Successful Removed Year');
    }



    
}