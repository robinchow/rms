<?php

class Merch_Order extends Eloquent {
	public static $timestamps = true;

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function year()
	{
		return $this->belongs_to('Year');
	}

	public function items()
    {
        return $this->has_many_and_belongs_to('Merch_Item', 'merch_item_order')->with('quantity','size');
    }

    public function total() {
    	$total = 0.0;
    	foreach ($this->items as $i) {
    		$total += $i->price * $i->pivot->quantity;
    	}
    	return $total;
    }

    public function remaining() {
    	return ($this->total() - $this->amount_paid);
    }
}
