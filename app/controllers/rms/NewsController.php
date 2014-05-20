<?php

class NewsController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
        $this->beforeFilter('auth');
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
            'title'  => 'required',
            'post'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            News::find($id)->update(Input::get());

            return Redirect::to('rms/news')
                ->with('success', 'Successfully Edited News Post');
        }
        else
        {
            return Redirect::to('rms/news/edit/' . $id)
                ->withErrors($validation)
                ->withInput();
        }
    }

        public function get_add()
    {
        return View::make('news.add');
    }

    public function post_add()
    {
        if (!Auth::user()->is_currently_part_of_exec()) {
            return Redirect::to('rms'); #TODO make this nicer
        }
        $input = Input::get();

        $rules = array(
            'title'  => 'required',
            'post'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $news =  News::create(Input::get());

            return Redirect::to('rms/news')
                ->with('success', 'Successfully Added New News Post');
        }
        else
        {
            return Redirect::to('rms/news/add')
                ->withErrors($validation)
                ->withInput();
        }


    }

    public function get_delete($id)
    {
        $news = News::find($id)->delete();
        return Redirect::to('rms/news')
                ->with('success', 'Successfully Removed news');
    }

    public function get_view($id)
    {
        $news = News::find($id);
        return View::make('news.view')->with('news', $news);
    }
    
}
