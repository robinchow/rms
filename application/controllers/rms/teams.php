<?php
class Rms_Teams_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index','join'));

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

        $team = Team::create(Input::get());

        return Redirect::to('rms/teams')
                ->with('status', 'Successful Added New Team');
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

        $team = Team::update($id, Input::get());

        return Redirect::to('rms/teams')
                ->with('status', 'Successful Edited Team');
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
        $team = Input::get('team_id');
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();//Hardocded should search current year from somewhere


        $user->teams()->attach($team, array('status' => 'interested', 'year_id'=>$year->id));
        

        return Redirect::to('rms/teams')
                ->with('status', 'Successful joined Team');
    }

    public function get_manage($id)
    {
        $team = Team::find($id);
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
        $users = array();
        foreach($year->users as $a ) {
            $users[] = $a->profile->full_name;
        }

        return View::make('teams.manage')
            ->with('team',$team)
            ->with('users',$users)
            ->with('year',$year); 
    }

    public function post_manage()
    {

        $user_fullname = Input::get('user');
        $profile = Profile::where('full_name','=',$user_fullname)->first();
        $user = $profile->user;
        $year_id = Input::get('year_id');
        $team_id = Input::get('team_id');
        $status = Input::get('status');

        $user->teams()->attach($team_id, array('status' => $status, 'year_id'=>$year_id));
        
        return Redirect::to('rms/teams/manage/' . $team_id)
                ->with('status', 'Successful added member Team');
    }

    //should be changed to a ajax post
    public function get_member_remove($user_id,$team_id, $year_id, $status = '')
    {
        $user = User::find($user_id);
        $user->teams()->where('team_id','=',$team_id)->where('status', '=', $status)->where('year_id','=',$year_id)->first()->pivot->delete();

        return Redirect::to('rms/teams/manage/' . $team_id)
                ->with('status', 'Successful added member Team');
    }

    public function get_member_move($user_id,$team_id, $year_id, $status = '')
    {
        $user = User::find($user_id);
        $join = $user->teams()->where('team_id','=',$team_id)->where('year_id','=',$year_id)->first()->pivot;
        $join->status = $status;
        $join->save();

        return Redirect::to('rms/teams/manage/' . $team_id)
               ->with('status', 'Successful added member Team');
    }


    public function get_delete($id)
    {
        $team = Team::find($id)->delete();
        return Redirect::to('rms/teams')
                ->with('status', 'Successful Removed Team');
    }



    
}