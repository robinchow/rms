<?php
class Rms_Executives_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index','show'));

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
        $input = Input::get();

        $rules = array(
            'position'  => 'required',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $executive = Executive::create(Input::get());

            return Redirect::to('rms/executives')
                    ->with('status', 'Successful Added New Executive');
        }
        else
        {
            var_dump($validation->errors);
        }

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
        $input = Input::get();

        $rules = array(
            'position'  => 'required',
            'alias' => 'required|max:128',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
        $executive = Executive::update($id, Input::get());

        return Redirect::to('rms/executives')
                ->with('status', 'Successful Edited Executive');
        }
        else
        {
            var_dump($validation->errors);
        }
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
        $executive = Executive::find(Input::get('executive_id'));
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();

        

        if(!$user->is_part_of_exec($year->id, $executive->id))
        {
            $user->executives()->attach($executive, array('non_executive' => Input::get('non_executive',0), 'year_id'=>$year->id));
            return Redirect::to('rms/executives')
                ->with('status', 'Successful joined Executive');
        }
        else 
        {
             return Redirect::to('rms/executives')
                 ->with('status', 'You are already a member of that executive');
        }
    }

    public function get_delete($id)
    {
        $executive = Executive::find($id)->delete();
        return Redirect::to('rms/executives')
                ->with('status', 'Successful Removed Executive');
    }



    
}