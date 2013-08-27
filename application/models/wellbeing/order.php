<?php

class Wellbeing_Order extends Eloquent {
	public static $timestamps = true;


    public function nights()
    {
        return $this->has_many_and_belongs_to('Wellbeing_Night', 'wellbeing_night_order');
    }

    public function year()
    {
        return $this->belongs_to('Year');
    }


    public function total() 
    {
        $mynight_count = count($this->nights);
        $allnight_count = count(Wellbeing_Night::current_nights()->get());
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
