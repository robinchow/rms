<?php
class Rms_Blog_Posts_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
#        $this->filter('before', 'admin')->except('index');

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
            $news = News::update($id, Input::get());

            return Redirect::to('rms/news')
                ->with('success', 'Successfully Edited News Post');
        }
        else
        {
            return Redirect::to('rms/news/edit/' . $id)
                ->with_errors($validation)
                ->with_input();
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
                ->with_errors($validation)
                ->with_input();
        }


    }

    public function get_delete($id)
    {
        $news = News::find($id)->delete();
        return Redirect::to('rms/news')
                ->with('success', 'Successfully Removed news');
    }
    
}
