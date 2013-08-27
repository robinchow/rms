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
}
