<?php

class Home_Controller extends Base_Controller {

    public $restful = true;

	public function get_index()
	{
		$sponsors = Sponsor::all();
		$news = News::order_by('updated_at', 'desc')->first();
		return View::make('home.index')
		->with('news',$news)
		->with('sponsors',$sponsors);
	}



	//FAQ
	public function get_faqs()
	{
		$faqs = Faq::all();
        return View::make('home.faqs')->with('faqs', $faqs);
	}

	//Exec
	public function get_exec()
	{
        $year = Year::current_year();
       
       	$execs = $year->executives();

        return View::make('home.exec')->with('execs', $execs)
        	->with('year', $year);
	}


	//Teams
	public function get_teams($id=NULL)
	{
		if($id)
		{
			$team = Team::find($id);
			return View::make('home.team_individual')->with('team', $team);
		} 
		else
		{
			$teams = Team::all_active()->get();
        	return View::make('home.teams')->with('teams', $teams);
		}
	}

	//History
	public function get_history()
	{
        $years = Year::order_by('year', 'desc')->get();

        return View::make('home.history')->with('years', $years);
	}

	//Sponsors 
	public function get_sponsors()
	{
        $year = Year::current_year();

        return View::make('home.sponsors')->with('year', $year);
	}


}