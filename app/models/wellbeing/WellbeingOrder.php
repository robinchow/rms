<?php

class WellbeingOrder extends Eloquent {
    
    protected $fillable = array('user_id', 'year_id', 'dietary_requirements', 
                                'paid', 'all');

    public function user() 
    {
        return $this->belongsTo('User');
    }


    public function nights()
    {
        return $this->belongsToMany('WellbeingNight', 'wellbeing_night_order');
    }

    public function year()
    {
        return $this->belongsTo('Year');
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
