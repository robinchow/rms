<?php
class Rms_Merch_Items_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'admin');
    }

    public function get_index()
    {
    	$items = Merch_Item::All();
        return View::make('merch.items.index')->with('items',$items);
    }

    public function get_add()
    {
        return View::make('merch.items.add');
    }

    public function post_add()
    {

        $input = Input::get();
        $input['has_size'] = Input::get('has_size', 0);
        $input['active'] = Input::get('active', 0);


        $rules = array(
            'title'  => 'required',
            'description' => 'required',
            'price'  => 'required',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $item = Merch_item::create(Input::get());

            return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Added New Item');
        }
        else
        {
            return Redirect::to('rms/merch/items/add')
                ->with_errors($validation)
                ->with_input(); 
        }


    }

    public function get_show($id)
    {
    	$item = Merch_item::find($id);
        return View::make('merch.items.show')->with('item',$item);
    }

    public function get_edit($id)
    {
    	$item = Merch_item::find($id);
        return View::make('merch.items.edit')
        	->with('item',$item);
    }

    public function post_edit($id)
    {

        $input = Input::get();
        $input['has_size'] = Input::get('has_size', 0);
        $input['active'] = Input::get('active', 0);


        $rules = array(
            'title'  => 'required',
            'description' => 'required',
            'price'  => 'required',
        );


        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $item = Merch_item::update($id,$input);

            return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Edited a Item');
        }
        else
        {
            return Redirect::to('rms/merch/items/edit/'.$id)
                ->with_errors($validation)
                ->with_input(); 
        }


    }


    public function get_delete($id)
    {
        $item = Merch_item::find($id)->delete();
        return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Removed Item');
    }
}