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
        $input = Input::get();

        $rules = array(
            'year'  => 'required|numeric',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $years = Year::create(Input::get());

            return Redirect::to('rms/years')
                ->with('status', 'Successful Added New Year');
        }
        else
        {
            var_dump($validation->errors);
        }
    }

    public function get_edit($id)
    {
        $year = Year::find($id);
        return View::make('years.edit')->with('year',$year);
    }

    public function post_edit($id)
    {

        $input = Input::all();

        $rules = array(
            'year'  => 'required|numeric',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        
        if($validation->passes())
        {
            $year = Year::update($id, Input::all());

            return Redirect::to('rms/years')
                ->with('status', 'Successful Edited Year');
        }
        else 
        {
            var_dump($validation->errors);

        }
    }

    public function get_delete($id)
    {
        $year = Year::find($id)->delete();
        return Redirect::to('rms/years')
                ->with('status', 'Successful Removed Year');
    }



    
}