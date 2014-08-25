<?php
class WellbeingOrdersController extends BaseController
{

    public $restful = true;

    public function __construct() 
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('before', array('only' => (array('exec', 'delete'))));
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
        $bundles = WellbeingBundle::current_bundles()->get();
        $nights = WellbeingNight::current_nights()->get();
        return View::make('wellbeing.orders.new')->with('nights', $nights)->with('bundles', $bundles);
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

            $bundle_id = Input::get('bundle');

            if ($bundle_id == 'custom') {
                
                $yes = Input::get('yes');

                unset($input['yes']);

                $wellbeing_order = WellbeingOrder::create($input);
                if($yes) {
                    foreach(WellbeingNight::current_nights()->get() as $night) {
                        if (array_key_exists($night->id, $yes)) {
                            if(intval($yes[$night->id]) == 1) {
                                $wellbeing_order->nights()->attach($night->id);
                            }
                        }
                    }
                }

            } else {

                $bundle = WellbeingBundle::find($bundle_id);
                $order = WellbeingOrder::create($input);
                $order->bundles()->attach($bundle);

            }
            return Redirect::to('rms/wellbeing/orders/')
                ->with('success', 'Successfully Created Order');
        }
        else
        {
            return Redirect::to('rms/wellbeing/orders/new')
                ->withErrors($validation)
                ->withInput(); 
        }
       

    }

    public function get_admin($current='current') {

        if($current=='current') {
            $year = Year::current_year();
        } else {
            $year = Year::find($current);
        }

        if($year) {
            $nights = WellbeingNight::current_nights()->get();
            $orders = WellbeingOrder::current_orders()->get();

            return View::make('wellbeing.orders.admin')->with('nights', $nights)->with('year', $year)->with('orders', $orders);
 

        } else {
            return "Invalid ID";
        }
    }

    public function get_edit()
    {
        $nights = WellbeingNight::current_nights()->get();

        $order = Auth::User()->wellbeing_orders_year(Year::current_year()->id)->first()->id;
        $order = WellbeingOrder::find($order);

        $mynights = array();
        foreach($nights as $night) 
        {
                $mynights[$night->id] = 0;
        }
        foreach($order->nights as $night) 
        {
                $mynights[$night->id] = 1;
        }

        return View::make('wellbeing.orders.edit')
            ->with('order', $order)
            ->with('nights', $nights)
            ->with('mynights', $mynights)
            ->with('bundle', $order->bundles()->first());
        
    }

    public function get_delete()
    {
        $id = Auth::User()->wellbeing_orders_year(Year::current_year()->id)->first()->id;
        $order = WellbeingOrder::find($id);
        $order->nights()->detach();
        $order->bundles()->detach();
        $order->delete();
        return Redirect::to('rms/wellbeing/orders/')
            ->with('success', 'Successfully Cancelled Order');
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

            $wellbeing_order = WellbeingOrder::find($id);

            $wellbeing_order->update($input);

            $wellbeing_order->nights()->detach();

            if($yes) {
                foreach(WellbeingNight::current_nights()->get() as $night) {
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
                ->withErrors($validation)
                ->withInput(); 
        }

        
    }


}
