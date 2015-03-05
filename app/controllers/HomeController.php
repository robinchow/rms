<?php

class HomeController extends BaseController {

    public $restful = true;

    protected $layout = 'templates.home';

    public function getIndex()
    {
        $year = Year::current_year();
        $sponsors = $year->sponsors()->orderBy('sponsor_year.sponsor_level', 'desc')->where('sponsor_year.sponsor_level', '!=', 'Affiliate')->get();
        $news = News::orderBy('updated_at', 'desc')->first();
        return View::make('home.index')
        ->with('news',$news)
        ->with('sponsors',$sponsors);
    }



    //FAQ
    public function getFaqs()
    {
        $faqs = Faq::all();
        return View::make('home.faqs')->with('faqs', $faqs);
    }

    //Exec
    public function getExec()
    {
        $year = Year::current_year();

        $execs = $year->executives();

        return View::make('home.exec')->with('execs', $execs)
            ->with('year', $year);
    }


    //Teams
    public function getTeams($id=NULL)
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
    public function getHistory()
    {
        $years = Year::orderBy('year', 'desc')->get();

        return View::make('home.history')->with('years', $years);
    }

    //Sponsors
    public function getSponsors()
    {
        $year = Year::current_year();
        $sponsors = $year->sponsors()->orderBy('sponsor_year.sponsor_level', 'desc')->get();
        return View::make('home.sponsors')->with('year', $year)->with('sponsors', $sponsors);
    }

    public function getSponsorshipOpportunities()
    {
        return View::make('home.sponsorship-opportunities');
    }

}
