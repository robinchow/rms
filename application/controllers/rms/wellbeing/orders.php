<?php
class Rms_Wellbeing_Orders_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->only(array('admin', 'edit', 'delete'));
    }

    public function get_index()
    {

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

    public function get_admin($current='current') {

        if($current=='current') {
            $year = Year::current_year();
        } else {
            $year = Year::find($current);
        }

        if($year) {

 

        } else {
            return "Invalid ID";
        }
    }

    public function get_edit($id)
    {
    }

    public function post_edit()
    {
        
    }


    public function get_delete($id)
    {
       
    }
}