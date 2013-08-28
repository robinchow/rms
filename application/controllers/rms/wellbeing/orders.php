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
        $wo = Auth::User()->wellbeing_orders_year(Year::current_year()->id)->get();

        if (count($wo) == 0) {
            return Redirect::to('rms/wellbeing/orders/new');
        } else {
            return Redirect::to('rms/wellbeing/orders/edit');
        }

    }

    public function get_new()
    {
        $nights = Wellbeing_Night::current_nights()->get();
        return View::make('wellbeing.orders.new')->with('nights', $nights);
    }

    public function post_new()
    {

        $input = Input::get();


        $rules = array(
            'year_id'  => 'required',
            'user_id' => 'required',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $yes = Input::get('yes');

            unset($input['yes']);

            $wellbeing_order = Wellbeing_Order::create($input);

            if($yes) {
                foreach(Wellbeing_Night::current_nights()->get() as $night) {
                    if(intval($yes[$night->id]) == 1) {
                        $wellbeing_order->nights()->attach($night->id);
                    }
                }
            }




            return Redirect::to('rms/wellbeing/orders/')
                ->with('success', 'Successfully Created Order');
        }
        else
        {
            return Redirect::to('rms/wellbeing/orders/new')
                ->with_errors($validation)
                ->with_input(); 
        }
       

    }

    public function get_admin($current='current') {

        if($current=='current') {
            $year = Year::current_year();
        } else {
            $year = Year::find($current);
        }

        if($year) {
            $nights = Wellbeing_Night::current_nights()->get();

            return View::make('wellbeing.orders.admin')->with('nights', $nights)->with('year', $year);
 

        } else {
            return "Invalid ID";
        }
    }

    public function get_edit()
    {
        $nights = Wellbeing_Night::current_nights()->get();

        $order = Auth::User()->wellbeing_orders_year(Year::current_year()->id)->first()->id;
        $order = Wellbeing_Order::find($order);

        $mynights = array();
        foreach($nights as $night) 
        {
                $mynights[$night->id] = 0;
        }
        foreach($order->nights as $night) 
        {
                $mynights[$night->id] = 1;
        }

        return View::make('wellbeing.orders.edit')->with('order', $order)->with('nights', $nights)->with('mynights', $mynights);
        
    }

    public function post_edit($id)
    {
        $input = Input::get();


        $rules = array(
            'year_id'  => 'required',
            'user_id' => 'required',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $yes = Input::get('yes');

            unset($input['yes']);

            $wellbeing_order = Wellbeing_Order::update($id, $input);

            $wellbeing_order = Wellbeing_Order::find($id);

            $wellbeing_order->nights()->delete();

            if($yes) {
                foreach(Wellbeing_Night::current_nights()->get() as $night) {
                    if(array_key_exists($night->id, $yes)) {
                        $wellbeing_order->nights()->attach($night->id);
                    }
                }
            }




            return Redirect::to('rms/wellbeing/orders/')
                ->with('success', 'Successfully Edited Order');
        }
        else
        {
            return Redirect::to('rms/wellbeing/orders/edit')
                ->with_errors($validation)
                ->with_input(); 
        }

        
    }


    public function get_delete($id)
    {
       
    }
}