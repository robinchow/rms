<?php
class Rms_Executives_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index'));

    }

    public function get_index()
    {
        $executives = Executive::all();
        return View::make('executives.index')->with('executives', $executives);
    }

    public function get_add()
    {
        return View::make('executives.add');
    }

    public function post_add()
    {

        $executive = Executive::create(Input::get());

        return Redirect::to('rms/executives')
                ->with('status', 'Successful Added New Executive');
    }

    public function get_show($id)
    {
        $executive = Executive::find($id);
        $years = Year::order_by('year', 'desc')->get();
        return View::make('executives.show')->with('executive',$executive)->with('years',$years);
    }

    public function get_edit($id)
    {
        $executive = Executive::find($id);
        return View::make('executives.edit')->with('executive',$executive);
    }

    public function post_edit($id)
    {

        $executive = Executive::update($id, Input::get());

        return Redirect::to('rms/executives')
                ->with('status', 'Successful Edited Executive');
    }

    public function get_join()
    {
        $executives = Executive::lists('position', 'id');

        return View::make('executives.join')
            ->with('executives',$executives);
    }

    public function post_join()
    {
        $user = Auth::User();
        $executive = Input::get('executive_id');
        $year = Year::where('year','=',2013)->first();//Hardocded should search current year from somewhere


        $user->executives()->attach($executive, array('non_executive' => Input::get('non_executive',0), 'year_id'=>$year->id));
        

        return Redirect::to('rms/executives')
                ->with('status', 'Successful joined Executive');
    }

    public function get_delete($id)
    {
        $executive = Executive::find($id)->delete();
        return Redirect::to('rms/executives')
                ->with('status', 'Successful Removed Executive');
    }



    
}