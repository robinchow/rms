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
        $teams = Team::all();
        return View::make('teams.index')->with('teams', $teams);
    }


    
}