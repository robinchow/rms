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




}