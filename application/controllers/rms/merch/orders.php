<?php
class Rms_Merch_Orders_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {

    }

    public function get_index()
    {
    	$orders = Auth::user()->orders()->get();
    	//var_dump($orders);
        return View::make('merch.orders.index')->with('orders',$orders);
    }

    public function get_new()
    {
        $merch = Merch_Item::current_merch()->get();
        return View::make('merch.orders.new')->with('merch', $merch);
    }

    public function post_new()
    {


    }

    public function get_show($id)
    {

    }

    public function get_edit($id)
    {

    }

    public function post_edit($id)
    {




    }


    public function get_delete($id)
    {

    }
}