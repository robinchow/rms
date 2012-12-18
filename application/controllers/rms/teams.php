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

    public function get_manage()
    {
        
    }

    public function get_delete($id)
    {
        $team = Team::find($id)->delete();
        return Redirect::to('rms/teams')
                ->with('status', 'Successful Removed Team');
    }



    
}