<?php
class Rms_Faqs_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'exec');

    }

    public function get_index()
    {
        $faqs = Faq::all();
        return View::make('faqs.index')->with('faqs', $faqs);
    }

    public function get_edit($id)
    {

        $faq = Faq::find($id);
        return View::make('faqs.edit')->with('faq',$faq);
    }

    public function post_edit($id)
    {

        $input = Input::get();

        $rules = array(
            'question'  => 'required',
            'answer'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $faq = Faq::update($id, Input::get());

            return Redirect::to('rms/faqs')
                ->with('success', 'Successfully Edited Faq');
        }
        else
        {
            return Redirect::to('rms/faqs/edit/'.$id)
                ->with_errors($validation)
                ->with_input(); 
        }
    }

        public function get_add()
    {
        return View::make('faqs.add');
    }

    public function post_add()
    {

        $input = Input::get();

        $rules = array(
            'question'  => 'required',
            'answer'  => 'required',

        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $faq =  Faq::create(Input::get());

            return Redirect::to('rms/faqs')
                ->with('success', 'Successfully Added New faq');
        }
        else
        {
            return Redirect::to('rms/faqs/add/')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

    public function get_delete($id)
    {
        $faq = Faq::find($id)->delete();
        return Redirect::to('rms/faqs')
                ->with('success', 'Successfully Removed faq');
    }
    
}