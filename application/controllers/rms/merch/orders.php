<?php
class Rms_Merch_Orders_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct() 
    {
        $this->filter('before', 'auth');
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

        $input = Input::get();


        $rules = array(
            'year_id'  => 'required',
            'user_id' => 'required',
        );

        $validation = Validator::make($input, $rules);
        

        if($validation->passes())
        {
            $quantities = $input['quantity'];
            $sizes = $input['size'];

            unset($input['quantity']);
            unset($input['size']);

            $merch_order = Merch_order::create($input);

            foreach(Merch_Item::current_merch()->get() as $item) {
                if(intval($quantities[$item->id]) > 0) {
                    $merch_order->items()->attach($item->id, array('quantity' => $quantities[$item->id], 'size'=>$sizes[$item->id]));
                }
            }




            return Redirect::to('rms/merch/orders')
                ->with('success', 'Successfully Created Order');
        }
        else
        {
            return Redirect::to('rms/merch/orders/new')
                ->with_errors($validation)
                ->with_input(); 
        }

    }

    public function get_show($id)
    {
        $order = Merch_order::find($id);
        $items = $order->items;

        return View::make('merch.orders.show')->with('order', $order);

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