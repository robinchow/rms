<?php
class Rms_Blog_Posts_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'exec')->except(array('index', 'show'));

    }

    public function get_index()
    {
        $blog_posts = Blog_Post::all();
        return View::make('blog.index')->with('blog_posts', $blog_posts);
    }

    public function get_edit($id)
    {

        $blog_posts = Blog_post::find($id);
        return View::make('blog.edit')->with('blog_posts',$blog_posts);
    }

        public function get_show($id)
    {

        $blog_posts = Blog_post::find($id);
        return View::make('blog.show')->with('blog_posts',$blog_posts);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'title'  => 'required',
            'body'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $blog_post = Blog_Post::update($id, Input::get());

            return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Edited Blog Post');
        }
        else
        {
            return Redirect::to('rms/blog/posts/edit/' . $id)
                ->with_errors($validation)
                ->with_input();
        }
    }

        public function get_add()
    {
        return View::make('blog.add');
    }

    public function post_add()
    {
        $input = Input::get();

        $rules = array(
            'title'  => 'required',
            'body'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $blog_post =  Blog_Post::create(Input::get());

            return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Added New Blog Post');
        }
        else
        {
            return Redirect::to('rms/blog/posts/add')
                ->with_errors($validation)
                ->with_input();
        }


    }

    public function get_delete($id)
    {
        $blog_post = Blog_Post::find($id)->delete();
        return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Removed posts');
    }
    
}
