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



    public function post_edit($id)
    {
        $sponsor = Sponsor::find($id);

        $input = Input::get();

        $rules = array(
            'name'  => 'required',
            'url'  => 'required|url',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            if(Input::has_file('image')) {
                File::delete(path('base').'/public/img/sponsor/' . $sponsor->image);
                Input::upload('image', path('base').'/public/img/sponsor',Input::file('image.name'));
                Input::merge(array('image' => Input::file('image.name')));
            }

            $sponsor =  Sponsor::update($id, Input::get());

            return Redirect::to('rms/sponsors')
                ->with('status', 'Successful Added New sponsors');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }
    }


    public function get_add_to_year($id)
    {

        $sponsor = Sponsor::find($id);
        $years = Year::lists('year', 'id');
        return View::make('sponsors.add_to_year')->with('sponsor',$sponsor)
        ->with('years',$years);
    }

    public function post_add_to_year($id)
    {

        $year_id = Input::get('year_id');

        $sponsor = Sponsor::find($id);

        $sponsor->years()->attach($year_id);



        return Redirect::to('rms/sponsors')
                ->with('status', 'Successful Added to a sponsor to year');
    }
    public function get_remove_from_year($id)
    {

        $sponsor = Sponsor::find($id);
        $years = Year::lists('year', 'id');
        return View::make('sponsors.remove_from_year')->with('sponsor',$sponsor)
        ->with('years',$years);
    }

    public function post_remove_from_year($id)
    {

        $year_id = Input::get('year_id');

        $sponsor = Sponsor::find($id);

        $sponsor->years()->detach($year_id);


        return Redirect::to('rms/sponsors')
             ->with('status', 'Successful removed sponsor from year');
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
            'url'  => 'required|url',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            if(Input::has_file('image')) {
                Input::upload('image', path('base').'/public/img/sponsor',Input::file('image.name'));
                Input::merge(array('image' => Input::file('image.name')));
            }

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