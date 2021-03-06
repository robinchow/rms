<?php

class ExecutivesController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('except' => array('get_index','get_show')));

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
                    ->with('success', 'Successfully Added New Executive Position');
        }
        else
        {
            return Redirect::to('rms/executives/add')
                ->withErrors($validation)
                ->withInput();
        }

    }

    public function get_show($id)
    {
        $executive = Executive::find($id);
        $years = Year::orderBy('year', 'desc')->get();
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
        Executive::find($id)->update(Input::get());

        return Redirect::to('rms/executives')
                ->with('success', 'Successfully Edited Executive');
        }
        else
        {
            return Redirect::to('rms/executives/edit/'. $id)
                ->withErrors($validation)
                ->withInput();
        }
    }



    public function get_manage($id)
    {
        $executive = Executive::find($id);
        $year = Year::current_year();
        $users = array();
        foreach($year->users as $a ) {
            $users[] = $a->profile->full_name;
        }


        return View::make('executives.manage')
            ->with('executive',$executive)
            ->with('users',$users)
            ->with('year',$year);
    }

    public function post_manage()
    {

        $user_fullname = Input::get('user');
        $year_id = Input::get('year_id');
        $executive_id = Input::get('executive_id');
        $profile = Profile::where('full_name','=',$user_fullname)->first();
        if (!$profile)
        {
            return Redirect::to('rms/executives/manage/' . $executive_id)
                 ->with('warning', 'Please enter a member');
        }
        $user = $profile->user;

        if(!$user->is_part_of_exec($year_id, $executive_id))
        {
            $user->executives()->attach($executive_id, array('non_executive' => Input::get('non_executive',0),'year_id'=>$year_id));

            return Redirect::to('rms/executives/manage/' . $executive_id)
                ->with('success', 'Successfully added member to executive');
        }
        else
        {
             return Redirect::to('rms/executives/manage/' . $executive_id)
                 ->with('warning', 'They are already a member of that executive');
        }
    }

    public function get_member_remove($user_id,$executive_id, $year_id)
    {
        $user = User::find($user_id);
        $user->executives()->where('executive_id','=',$executive_id)->where('year_id','=',$year_id)->first()->pivot->delete();

        return Redirect::to('rms/executives/manage/' . $executive_id)
                ->with('success', 'Successfully deleted member');
    }

    public function get_delete($id)
    {
        $executive = Executive::find($id)->delete();
        return Redirect::to('rms/executives')
                ->with('success', 'Successfully Removed Executive Position');
    }
}
