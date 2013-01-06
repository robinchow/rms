<?php
class Rms_News_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except('index');

    }

    public function get_index()
    {
        $news = News::all();
        return View::make('news.index')->with('news', $news);
    }

    public function get_edit($id)
    {

        $news = News::find($id);
        return View::make('news.edit')->with('news',$news);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'post'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $news = News::update($id, Input::get());

            return Redirect::to('rms/news')
                ->with('success', 'Successful Edited News');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }
    }

        public function get_add()
    {
        return View::make('news.add');
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'post'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $news =  News::create(Input::get());

            return Redirect::to('rms/news')
                ->with('status', 'Successful Added New news');
        }
        else
        {
            print '<pre>';
            var_dump($validation->errors);
        }


    }

    public function get_delete($id)
    {
        $news = News::find($id)->delete();
        return Redirect::to('rms/news')
                ->with('status', 'Successful Removed news');
    }
    
}