<?php

class SponsorsController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec');

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

        $input = Input::all();

        $rules = array(
            'name'  => 'required',
            'url'  => 'required|url',
            'image' => 'image'
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            if(Input::hasFile('image')) {
                $image_name = preg_replace('/.*\.(.+)/', $sponsor->id.".$1", Input::file('image')->getClientOriginalName());
                File::delete(base_path() . '/public/img/sponsor/' . $sponsor->image);
                Input::file('image')->move(base_path() . '/public/img/sponsor', $image_name);
                Input::merge(array('image' => $image_name));
 
            }

            $sponsor->update(Input::get());

            return Redirect::to('rms/sponsors')
                ->with('success', 'Successfully Edited Sponsor: ' . $sponsor->name);
        }
        else
        {
            return Redirect::to('rms/sponsors/edit/'.$id)
                ->with_errors($validation)
                ->with_input(); 
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
                ->with('success', 'Successfully Added to a sponsor to year');
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
             ->with('success', 'Successfully removed sponsor from year');
    }


    public function get_add()
    {
        return View::make('sponsors.add');
    }

    public function post_add()
    {

        $input = Input::all();

        $rules = array(
            'name'  => 'required',
            'url'  => 'required|url',
            'image' => 'image'

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {

            $sponsor = new Sponsor;
            $sponsor->name = Input::get('name');
            $sponsor->url = Input::get('url');
            $sponsor->save();

            if(Input::hasFile('image')) {
                $image_name = preg_replace('/.*\.(.+)/', $sponsor->id.".$1", Input::file('image')->getClientOriginalName());
                Input::file('image')->move(base_path() . '/public/img/sponsor', $image_name);
                $sponsor->image = $image_name;
                $sponsor->save();
            }
            

            return Redirect::to('rms/sponsors')
                ->with('success', 'Successfully Added New Sponsor: '.$sponsor->name);
        }
        else
        {
          return Redirect::to('rms/sponsors/add')
                ->withErrors($validation)
                ->withInput(); 
        }


    }

    public function get_delete($id)
    {
        $sponsors = Sponsor::find($id)->delete();
        return Redirect::to('rms/sponsors')
                ->with('success', 'Successfully Removed Sponsor');
    }
    
}
