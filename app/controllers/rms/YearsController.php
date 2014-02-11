<?php

class YearsController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
    /*
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index','show'));
*/
    }

    public function get_index()
    {
        $years = Year::orderBy('year', 'desc')->get();
        return View::make('years.index', array('years' => $years, 'user' => Auth::user()));
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
            'name'  => 'required',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $year = Year::create(Input::get());

            return Redirect::to('rms/years')
                ->with('success', 'Successfully Added New Year: ' . $year->year . ' - '. $year->name);
        }
        else
        {
            return Redirect::to('rms/years/add/')
                ->with_errors($validation)
                ->with_input();
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
            'name'  => 'required',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        
        if($validation->passes())
        {
            $year = Year::find($id);
            $year->update(Input::all());
            return Redirect::to('rms/years')
                ->with('success', 'Successfully Edited Year: '. $year->year . ' - '. $year->name);
        }
        else 
        {
            return Redirect::to('rms/years/edit/'.$id)
                ->with_errors($validation)
                ->with_input();

        }
    }

    public function get_delete($id)
    {
        $year = Year::find($id)->delete();
        return Redirect::to('rms/years')
                ->with('success', 'Successfully Removed Year');
    }



    
}
