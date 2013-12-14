<?php
class Rms_Wellbeing_Nights_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'exec')->except('show');

    }

    public function get_index()
    {
    	$nights = Wellbeing_Night::All();
        return View::make('wellbeing.nights.index')->with('nights',$nights);
    }

    public function get_add()
    {
    	$years = Year::lists('year', 'id');
        return View::make('wellbeing.nights.add')->with('years', $years);
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'year_id'  => 'required',
            'date' => 'required',
            'price'  => 'required|numeric',
            'special_price'  => 'required|numeric',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $item = Wellbeing_Night::create(Input::get());

            return Redirect::to('rms/wellbeing/nights')
                ->with('success', 'Successfully Added New Night');
        }
        else
        {
            return Redirect::to('rms/wellbeing/nights/add')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

    public function get_edit($id)
    {
    	$night = Wellbeing_Night::find($id);
    	  $years = Year::lists('year', 'id');
        return View::make('wellbeing.nights.edit')
        	->with('night',$night)->with('years', $years);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'year_id'  => 'required',
            'date' => 'required',
            'price'  => 'required|numeric',
            'special_price'  => 'required|numeric',

        );


        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $night = Wellbeing_Night::update($id,$input);

            return Redirect::to('rms/wellbeing/nights')
                ->with('success', 'Successfully Edited a Night');
        }
        else
        {
            return Redirect::to('rms/wellbeing/nihgts/edit/'.$id)
                ->with_errors($validation)
                ->with_input(); 
        }


    }


    public function get_delete($id)
    {
        $night = Wellbeing_Night::find($id)->delete();
        return Redirect::to('rms/wellbeing/nights')
                ->with('success', 'Successfully Removed Night');
    }
}