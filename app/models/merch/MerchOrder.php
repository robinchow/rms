<?php

class MerchOrder extends Eloquent {

    protected $fillable = array('user_id', 'year_id', 'amount_paid');

    public function user()
	{
		return $this->belongsTo('User');
	}

	public function year()
	{
		return $this->belongsTo('Year');
	}

	public function items()
    {
        return $this->belongsToMany('MerchItem', 'merch_item_order')->withPivot('quantity', 'size');
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

    public function locked() {
        return $this->amount_paid != 0;
    }

    public function paid() {
        return $this->remaining() == 0;
    }
}
