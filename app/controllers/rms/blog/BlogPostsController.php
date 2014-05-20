<?php
class BlogPostsController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('except' => array('index', 'show')));

    }

    public function get_index()
    {
        $blog_posts = BlogPost::all();
        return View::make('blog.index')->with('blog_posts', $blog_posts);
    }

    public function get_edit($id)
    {

        $blog_posts = BlogPost::find($id);
        return View::make('blog.edit')->with('blog_posts',$blog_posts);
    }

        public function get_show($id)
    {

        $blog_posts = BlogPost::find($id);
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
            BlogPost::find($id)->update(Input::get());

            return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Edited Blog Post');
        }
        else
        {
            return Redirect::to('rms/blog/posts/edit/' . $id)
                ->withErrors($validation)
                ->withInput();
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
            $blog_post =  BlogPost::create(Input::get());

            return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Added New Blog Post');
        }
        else
        {
            return Redirect::to('rms/blog/posts/add')
                ->withErrors($validation)
                ->withInput();
        }


    }

    public function get_delete($id)
    {
        $blog_post = BlogPost::find($id)->delete();
        return Redirect::to('rms/blog/posts')
                ->with('success', 'Successfully Removed posts');
    }
    
}
