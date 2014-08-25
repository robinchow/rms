<?php

class WellbeingNight extends Eloquent {

    protected $fillable = array('year_id', 'date', 'price', 'special_price', 'description');

	public static function current_nights()
    {
        return WellbeingNight::where('year_id', '=', Year::current_year()->id);
    }

    public function orders()
    {
        return $this->belongsToMany('WellbeingOrder', 'wellbeing_night_order');
    }

    public function bundle_orders()
    {
        $myorders = array();
        $orders = WellbeingOrder::current_orders()->get();
        foreach ($orders as $order) {
            if ($order->bundle() != null) {
                foreach ($order->bundle()->nights()->get() as $night) {
                    if ($night->id == $this->id) {
                        $myorders[] = $order;
                    }
                }
            }
        }

        return $myorders;
    }

    public function all_orders()
    {
        $orders = $this->bundle_orders();
        foreach ($this->orders as $order) {
            $orders[] = $order;
        }
        return $orders;
    }

    public function year()
    {
        return $this->belongsTo('Year');
    }

    public function getDateAttribute()
    {
        return date('D d-m-Y', strtotime($this->attributes['date']));
    }

    public function setDateAttribute($date)
    {
        $date = date('Y-m-d 00:00:00', strtotime($date));
        $this->attributes['date'] = $date;
    }

    public function count() {
        $total = 0;
        $orders = WellbeingOrder::current_orders()->get();
        foreach ($orders as $order) {
            if ($order->bundle() != null) {
                foreach ($order->bundle()->nights()->get() as $night) {
                    if ($night->id == $this->id) {
                        $total++;
                    }
                }
            }
        }

        return $this->orders()->count() + $total;
    }
}
