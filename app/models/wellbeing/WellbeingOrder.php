<?php

class WellbeingOrder extends Eloquent {
    
    protected $fillable = array('user_id', 'year_id', 'dietary_requirements', 
                                'paid', 'all');

    public function user() 
    {
        return $this->belongsTo('User');
    }

    public static function current_orders() {
        return WellbeingOrder::where('year_id', '=', Year::current_year()->id);
    }

    public function nights()
    {
        return $this->belongsToMany('WellbeingNight', 'wellbeing_night_order');
    }

    public function bundles()
    {
        return $this->belongsToMany('WellbeingBundle', 'wellbeing_bundle_order');
    }

    public function bundle()
    {
        return $this->bundles()->first();
    }


    public function year()
    {
        return $this->belongsTo('Year');
    }

    public function price()
    {
        if ($this->bundle() == null) {
            $price = 0;
            foreach ($this->nights as $night) {
                $price += $night->price;
            }
            return $price;
        } else {
            return $this->bundle()->price;
        }
    }

    public function total() 
    {
        $mynight_count = count($this->nights);
        $allnight_count = count(WellbeingNight::current_nights()->get());
        $total = 0;

        foreach($this->nights as $night) {
            if($mynight_count == $allnight_count) {
                $total += $night->special_price;
            } else {
                $total += $night->price;
            }
        }

        return $total;
    }
}
