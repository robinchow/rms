<?php

class Merch_Item extends Eloquent {
	public static $timestamps = true;

	public static function current_merch() 
    {
        return Merch_Item::where('active', '=', 1);
    }

    public function orders()
    {
        return $this->has_many_and_belongs_to('Merch_Order', 'merch_item_order')->with('quantity','size');
    }

    public function quantities($year_id, $size) 
    {
    	$quantity = 0;
    	$orders = $this->orders;
    	foreach($orders as $oi) {
    		if($oi->pivot->size == $size && $oi->year->id == $year_id) {
    			$quantity += $oi->pivot->quantity;
    		}
    	}


    	return $quantity;
    }
}
