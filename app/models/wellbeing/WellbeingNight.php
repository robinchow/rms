<?php

class WellbeingNight extends Eloquent {

    protected $fillable = array('year_id', 'date', 'price', 'special_price');

	public static function current_nights()
    {
        return WellbeingNight::where('year_id', '=', Year::current_year()->id);
    }

    public function orders()
    {
        return $this->belongsToMany('WellbeingOrder', 'wellbeing_night_order');
    }

    public function year()
    {
        return $this->belongsTo('Year');
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
