<?php
class WellbeingNightsController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('except'=>'show'));

    }

    public function get_index()
    {
    	$nights = WellbeingNight::orderBy('date')->get();
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

        return Input::get();

        if($validation->passes())
        {
            $item = WellbeingNight::create(Input::get());

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
    	$night = WellbeingNight::find($id);
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
            WellbeingNight::find($id)->update($input);

            return Redirect::to('rms/wellbeing/nights')
                ->with('success', 'Successfully Edited a Night');
        }
        else
        {
            return Redirect::to('rms/wellbeing/nihgts/edit/'.$id)
                ->withErrors($validation)
                ->withInput();
        }


    }


    public function get_delete($id)
    {
        $night = WellbeingNight::find($id)->delete();
        return Redirect::to('rms/wellbeing/nights')
                ->with('success', 'Successfully Removed Night');
    }
}
