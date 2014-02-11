<?php

class Wellbeing_Night extends Eloquent {
	public static $timestamps = true;

	public static function current_nights() 
    {
        return Wellbeing_Night::where('year_id', '=', Year::current_year()->id);
    }

    public function orders()
    {
        return $this->has_many_and_belongs_to('Wellbeing_Order', 'wellbeing_night_order');
    }

    public function year()
    {
        return $this->belongs_to('Year');
    }

    public function get_date()
    {
        return date('d-m-Y', strtotime($this->get_attribute('date')));
    }

    public function set_date($date)
    {
        $date = date('Y-m-d 00:00:00', strtotime($date));
        $this->set_attribute('date', $date);
    }

    public function count() {
        return $this->orders()->count();
    }
}
