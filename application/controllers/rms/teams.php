<?php
class Rms_Teams_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('index'));

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

    public function get_join($id)
    {
        $team = Team::find($id);
        $years = Year::lists('year', 'id');

        return View::make('teams.join')
            ->with('team',$team)
            ->with('years',$years);
    }

    public function post_join()
    {
        $user = Auth::User();
        $team = Input::get('team_id');
        $year = Input::get('year_id');
        $user->teams()->attach($team, array('status' => 'interested', 'year_id'=>$year));
        

        return Redirect::to('rms/teams')
                ->with('status', 'Successful joined Team');
    }

    public function get_delete($id)
    {
        $team = Team::find($id)->delete();
        return Redirect::to('rms/teams')
                ->with('status', 'Successful Removed Team');
    }



    
}