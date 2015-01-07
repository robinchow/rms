<?php

class TeamsController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('view_team', array('only' => 'get_show'));
        $this->beforeFilter('manage_team', array('only' => array('get_edit', 'get_manage', 'post_edit', 'post_manage')));
        $this->beforeFilter('exec', array('only' => array('get_delete', 'get_renew')));
    }

    public function get_index($current='current')
    {
        if($current=='archive') {
            $teams = Team::all();
        } else {
            $teams = Team::all_active()->get();
        }
        return View::make('teams.index', array('teams' => $teams, 'user' => Auth::user()));
    }

    public function get_add()
    {
        return View::make('teams.add');
    }

    public function post_add()
    {
        $input = Input::get();

        $rules = array(
            'name'  => 'required|unique:teams',
            'alias' => 'required|max:128|unique:teams',
            'description'  => 'required',
        );

        $validation = Validator::make($input, $rules);


        if($validation->passes())
        {
            // Modify input variables
            $input['alias'] = strtolower($input['alias']);

            // Create the team
            $team = Team::create($input);

            // Make the team active for the current year
            Year::current_year()->teams()->attach($team->id);;

            return Redirect::to('rms/teams')
                ->with('success', 'Successfully Added New Team');
        }
        else
        {
            return Redirect::to('rms/teams/add')
                ->withErrors($validation)
                ->withInput();
        }


    }

    public function get_show($id)
    {
        $team = Team::find($id);
        return View::make('teams.show')->with('team',$team);
    }

    public function get_edit($id)
    {
        $cancel = '/rms/teams';
        if (Input::get('renew')) {
            $cancel = '/rms/teams/renew';
        }
        $team = Team::find($id);
        return View::make('teams.edit')->with('team',$team)->with('cancel', $cancel);
    }

    public function post_edit($id)
    {
        // renew the team if necessary
        if (Auth::User()->admin || Auth::User()->is_currently_part_of_exec()) {
            $team = Team::find($id);
            if (!$team->is_active()) {
                if (Input::get('renew')) {
                    Year::current_year()->teams()->attach($team->id);
                }
            } else {
                if (!Input::get('renew')) {
                    Year::current_year()->teams()->detach($team->id);
                }
            }
        }

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

            Team::find($id)->update(Input::except(array('renew')));

            return Redirect::to('rms/teams')
                ->with('success', 'Successfully Edited Team');
        }
        else
        {
            return Redirect::to('rms/teams/edit/'. $id)
                ->withErrors($validation)
                ->withInput();
        }

    }

    public function get_join()
    {
        $teams = Team::all_active()->where('privacy', '=', false)->lists('name', 'id');

        return View::make('teams.join')
            ->with('teams',$teams);
    }

    public function post_join()
    {
        $user = Auth::User();
        $team = Team::find(Input::get('team_id'));
        $year = Year::current_year();

        if(!$user->is_part_of_team($year->id, $team->id))
        {
            $user->teams()->attach($team->id, array('status' => 'interest', 'year_id'=>$year->id));
            return Redirect::to('rms/teams')
                ->with('success', 'Successfully joined Team');
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
        $year = Year::current_year();
        $users = array();
        foreach($year->users as $a ) {
            $users[] = $a->profile->full_name;
        }

        $statuses = array('member' => 'Member', 'head'=>'Head');
        if(!$team->privacy) {
            $statuses = array('interest' => 'Interested', 'member' => 'Member', 'head'=>'Head');
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
        $year_id = Input::get('year_id');
        $team_id = Input::get('team_id');
        $status = Input::get('status');
        $profile = Profile::where('full_name','=',$user_fullname)->first();
        if (!$profile)
        {
            return Redirect::to('rms/teams/manage/' . $team_id)
                 ->with('warning', 'Please enter a member');
        }
        $user = $profile->user;

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

    //Join and leave team could be merged
    public function get_member_join($team_id)
    {
        $user = Auth::User();
        $team = Team::find($team_id);
        $year = Year::current_year();

        if(!$user->is_part_of_team($year->id, $team->id))
        {
            $user->teams()->attach($team->id, array('status' => 'interest', 'year_id'=>$year->id));
            return Redirect::to('rms/teams')
                ->with('success', 'Successfully joined Team');
        }
        else
        {
             return Redirect::to('rms/teams')
                 ->with('warning', 'You are already a member of that team');
        }
    }

    public function get_member_join_ajax($team_id) {
        $user = Auth::User();
        $team = Team::find($team_id);
        $year = Year::current_year();

        if(!$user->is_part_of_team($year->id, $team->id))
        {
            $user->teams()->attach($team->id, array('status' => 'interest', 'year_id'=>$year->id));
            return View::make('teams.index.ajax')
                ->with('data', 'Join Successful')
                ->with('state', 'success')
                ;
        } else {
            return View::make('teams.index.ajax')
                ->with('data', 'Already member of team')
                ->with('state', 'warn')
                ;
        }

    }

    public function get_member_leave($team_id)
    {
        $user = Auth::User();
        $user->teams()->where('team_id','=',$team_id)->where('year_id','=',Year::current_year()->id)->first()->pivot->delete();

        return Redirect::to('rms/teams')
                ->with('success', 'Successful left team');
    }

    public function get_member_leave_ajax($team_id) {
        $user = Auth::User();
        $user->teams()->where('team_id','=',$team_id)->where('year_id','=',Year::current_year()->id)->first()->pivot->delete();

        return View::make('teams.index.ajax')
            ->with('data', 'Leave Successful')
            ->with('state', 'success')
            ;
    }

    //should be changed to a ajax post
    public function get_member_remove($user_id,$team_id, $year_id, $status = 'member')
    {

        DB::table('team_user')
            ->where('team_id', '=', $team_id)
            ->where('user_id', '=', $user_id)
            ->where('year_id', '=', $year_id)
            ->delete();


        return Redirect::to('rms/teams/manage/' . $team_id)
                ->with('warning', 'Successful deleted member');
    }

    public function get_member_move($user_id, $team_id, $year_id, $status = 'member')
    {

        DB::table('team_user')
            ->where('team_id', '=', $team_id)
            ->where('user_id', '=', $user_id)
            ->where('year_id', '=', $year_id)
            ->update(array('status' => $status));


        return Redirect::to('rms/teams/manage/' . $team_id)
               ->with('success', 'Successful moved team member');
    }


    public function get_delete($id)
    {
        $team = Team::find($id)->delete();
        return Redirect::to('rms/teams')
                ->with('status', 'Successful Removed Team');
    }


    public function get_renew()
    {
        $teams = Team::all();
        return View::make('teams.renew')->with('teams', $teams);
    }

}
