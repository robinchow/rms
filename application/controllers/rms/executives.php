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
                    ->with('success', 'Successfully Added New Executive Position');
        }
        else
        {
            return Redirect::to('rms/executives/add')
                ->with_errors($validation)
                ->with_input(); 
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
                ->with('success', 'Successfully Edited Executive');
        }
        else
        {
            return Redirect::to('rms/executives/edit/'. $id)
                ->with_errors($validation)
                ->with_input(); 
        }
    }



    public function get_manage($id)
    {
        $executive = Executive::find($id);
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
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
        $profile = Profile::where('full_name','=',$user_fullname)->first();
        $user = $profile->user;
        $year_id = Input::get('year_id');
        $executive_id = Input::get('executive_id');

        
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
                ->with('success', 'Successfully joined Executive Position');
        }
        else 
        {
             return Redirect::to('rms/executives')
                 ->with('warning', 'You are already a member of that executive');
        }
    }



    public function get_delete($id)
    {
        $executive = Executive::find($id)->delete();
        return Redirect::to('rms/executives')
                ->with('success', 'Successfully Removed Executive Position');
    }



    
}