<?php
class MerchItemsController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('except'=>'get_show'));

    }

    public function get_index()
    {
    	$items = MerchItem::All();
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
            'price'  => 'required',
        );

        $validation = Validator::make($input, $rules);


        if($validation->passes())
        {
            $item = MerchItem::create(Input::get());

            return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Added New Item');
        }
        else
        {
            return Redirect::to('rms/merch/items/add')
                ->withErrors($validation)
                ->withInput();
        }


    }

    public function get_show($id)
    {
    	$item = MerchItem::find($id);
        return View::make('merch.items.show')->with('item',$item);
    }

    public function get_edit($id)
    {
    	$item = MerchItem::find($id);
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
            MerchItem::find($id)->update($input);

            return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Edited a Item');
        }
        else
        {
            return Redirect::to('rms/merch/items/edit/'.$id)
                ->withErrors($validation)
                ->withInput();
        }


    }


    public function get_delete($id)
    {
        $item = MerchItem::find($id)->delete();
        return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Removed Item');
    }

    public function get_deactivate($id) {
        $item = MerchItem::find($id);
        $item->active = 0;
        $item->save();
        return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Deactivated Item');
    }
    public function get_activate($id) {
        $item = MerchItem::find($id);
        $item->active = 1;
        $item->save();
        return Redirect::to('rms/merch/items')
                ->with('success', 'Successfully Activated Item');
    }



}
