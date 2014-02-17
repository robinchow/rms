<?php

class MerchItem extends Eloquent {
    
    protected $fillable = array('title', 'description', 'price', 'has_size', 'active');

	public static function current_merch() 
    {
        return MerchItem::where('active', '=', 1);
    }

    public function orders()
    {
        return $this->belongsToMany('MerchOrder', 'merch_item_order')->withPivot('quantity','size');
    }

    public function quantities($year_id, $size) 
    {
    	$quantity = 0;
    	$orders = $this->orders;
    	foreach($orders as $oi) {
    		if($oi->pivot->size == $size 
            && $oi->year_id == $year_id) {
    			$quantity += $oi->pivot->quantity;
    		}
    	}


    	return $quantity;
    }
}
