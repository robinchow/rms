<?php

class Home_Controller extends Base_Controller {

    public $restful = true;

	public function get_index()
	{
		return View::make('home.index');
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
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
       
       	$execs = $year->executives;

       	print '<pre>';
       	var_dump($execs);
        return View::make('home.exec')->with('execs', $execs);
	}




}