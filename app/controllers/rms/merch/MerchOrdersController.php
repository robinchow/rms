<?php
class MerchOrdersController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('only' => array('exec', 'edit', 'delete')));
    }

    public function get_index()
    {
    	$orders = Auth::user()->orders()->get();
        return View::make('merch.orders.index')->with('orders',$orders);
    }

    public function get_new()
    {
        $merch = MerchItem::current_merch()->get();
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

            $total = 0;
            foreach($quantities as $q) {
                $total += $q;
            }
            if ($total == 0) {
                return Redirect::to('rms/merch/orders/new')
                    ->withErrors("Order did not include any items")
                    ->withInput();
            }

            unset($input['quantity']);
            unset($input['size']);

            $merch_order = MerchOrder::create($input);

            foreach(MerchItem::current_merch()->get() as $item) {
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
                ->withErrors($validation)
                ->withInput();
        }

    }

    public function get_show($id)
    {
        $order = MerchOrder::find($id);
        $items = $order->items;

        return View::make('merch.orders.show')->with('order', $order);

    }

    public function get_admin($current='current') {

        if($current=='current') {
            $year = Year::current_year();
        } else {
            $year = Year::find($current);
        }

        if($year) {

            $orders = MerchOrder::where('year_id', '=', $year->id)->get();
            $items = MerchItem::all();

            $sizes = array('8'=>'8','10'=>'10','12'=>'12','14'=>'14','XS'=>'XS','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL');
            return View::make('merch.orders.admin')
                ->with('orders',$orders)
                ->with('items', $items)
                ->with('sizes', $sizes)
                ->with('year', $year);

        } else {
            return "Invalid ID";
        }
    }

    public function get_edit($id)
    {
        $order = MerchOrder::find($id);
        return View::make('merch.orders.edit')->with('order', $order)->with('is_user', false);
    }
    public function get_user_edit($id)
    {
        $order = MerchOrder::find($id);
        return View::make('merch.orders.edit')->with('order', $order)->with('is_user', true);
    }

    public function post_edit()
    {

        $input = Input::get();
        $id = $input['order_id'];

        $rules = array(
            'order_id'  => 'required',
        );

        $validation = Validator::make($input, $rules);


        if($validation->passes())
        {
            $quantities = $input['quantity'];
            $sizes = $input['size'];

            unset($input['quantity']);
            unset($input['size']);
            unset($input['order_id']);

            $merch_order = MerchOrder::find($id);
            $merch_order->update($input);


            foreach($merch_order->items as $item) {
                $item->pivot->quantity =  $quantities[$item->id];
                $item->pivot->size = $sizes[$item->id];
                $item->pivot->save();
            }

            return Redirect::to('rms/merch/orders/admin')
               ->with('success', 'Successfully Edited Order');
        }
        else
        {
            return Redirect::to('rms/merch/orders/edit/'. $id)
                ->withErrors($validation)
                ->withInput();
        }
    }


    public function get_delete($id)
    {
        $order = MerchOrder::find($id)->delete();
        return Redirect::to('rms/merch/orders')
                ->with('success', 'Successfully Removed Order');
    }
}
