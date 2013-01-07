<?php
class Rms_Teams_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'manage_team')
            ->only(array('edit','manage'));
        $this->filter('before', 'admin')
            ->only(array('delete'));
    }

    public function get_index()
    {
        $teams = Team::all();
        return View::make('teams.index')->with('teams', $teams);
    }

    public function get_add()
    {
        return View::make('teams.add');
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'name'  => 'required',
            'alias' => 'required|max:128',
            'description'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $team = Team::create(Input::get());

            return Redirect::to('rms/teams')
                ->with('status', 'Successful Added New Team');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }


    }

    public function get_show($id)
    {
        $team = Team::find($id);
        $years = Year::order_by('year', 'desc')->get();
        return View::make('teams.show')->with('team',$team)->with('years',$years);
    }

    public function get_edit($id)
    {

        $team = Team::find($id);
        return View::make('teams.edit')->with('team',$team);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'name'  => 'required',
            'alias' => 'required|max:128',
            'description'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            Input::merge(array('privacy' => Input::get('privacy',0)));
            
            $team = Team::update($id, Input::get());

            return Redirect::to('rms/teams')
                ->with('success', 'Successful Edited Team');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }

    }

    public function get_join()
    {
        $teams = Team::where('privacy', '=', false)->lists('name', 'id');

        return View::make('teams.join')
            ->with('teams',$teams);
    }

    public function post_join()
    {
        $user = Auth::User();
        $team = Team::find(Input::get('team_id'));
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();

        if(!$user->is_part_of_team($year->id, $team->id))
        {
            $user->teams()->attach($team->id, array('status' => 'interested', 'year_id'=>$year->id));
            return Redirect::to('rms/teams')
                ->with('status', 'Successful joined Team');
        }
        else 
        {
             return Redirect::to('rms/teams/join')
                 ->with('warning', 'You are already a member of that team');
        }
    }

    public function get_manage($id)
    {
        $team = Team::find($id);
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
        $users = array();
        foreach($year->users as $a ) {
            $users[] = $a->profile->full_name;
        }

        $statuses = array('' => 'Member', 'head'=>'Head');
        if(!$team->privacy) {
            $statuses = array('interested' => 'Interested', '' => 'Member', 'head'=>'Head');
        } 


        return View::make('teams.manage')
            ->with('team',$team)
            ->with('users',$users)
            ->with('year',$year)
            ->with('statuses',$statuses); 
    }

    public function post_manage()
    {

        $user_fullname = Input::get('user');
        $profile = Profile::where('full_name','=',$user_fullname)->first();
        $user = $profile->user;
        $year_id = Input::get('year_id');
        $team_id = Input::get('team_id');
        $status = Input::get('status');

        
        if(!$user->is_part_of_team($year_id, $team_id))
        {
            $user->teams()->attach($team_id, array('status' => $status, 'year_id'=>$year_id));

            return Redirect::to('rms/teams/manage/' . $team_id)
                ->with('success', 'Successful added member to Team');
        }
        else 
        {
             return Redirect::to('rms/teams/manage/' . $team_id)
                 ->with('warning', 'They are already a member of that team');
        }
    }

    //should be changed to a ajax post
    public function get_member_remove($user_id,$team_id, $year_id, $status = '')
    {
        $user = User::find($user_id);
        $user->teams()->where('team_id','=',$team_id)->where('status', '=', $status)->where('year_id','=',$year_id)->first()->pivot->delete();

        return Redirect::to('rms/teams/manage/' . $team_id)
                ->with('warning', 'Successful deleted member');
    }

    public function get_member_move($user_id,$team_id, $year_id, $status = '')
    {
        $user = User::find($user_id);
        $join = $user->teams()->where('team_id','=',$team_id)->where('year_id','=',$year_id)->first()->pivot;
        $join->status = $status;
        $join->save();

        return Redirect::to('rms/teams/manage/' . $team_id)
               ->with('success', 'Successful moved team member');
    }


    public function get_delete($id)
    {
        $team = Team::find($id)->delete();
        return Redirect::to('rms/teams')
                ->with('status', 'Successful Removed Team');
    }



    
}