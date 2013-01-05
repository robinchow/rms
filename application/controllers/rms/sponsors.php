<?php
class Rms_Sponsors_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin');

    }

    public function get_index()
    {
        $sponsors = Sponsor::all();
        return View::make('sponsors.index')->with('sponsors', $sponsors);
    }

    public function get_edit($id)
    {

        $sponsor = Sponsor::find($id);
        return View::make('sponsors.edit')->with('sponsor',$sponsor);
    }


    public function get_add()
    {
        return View::make('sponsors.add');
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'name'  => 'required',
            'image'  => 'required',
            'url'  => 'required|url',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $sponsor =  Sponsor::create(Input::get());

            return Redirect::to('rms/sponsors')
                ->with('status', 'Successful Added New sponsors');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }


    }

    public function get_delete($id)
    {
        $sponsors = Sponsor::find($id)->delete();
        return Redirect::to('rms/sponsors')
                ->with('status', 'Successful Removed sponsor');
    }
    
}