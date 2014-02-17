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

    public function getDateAttribute()
    {
        return date('d-m-Y', strtotime($this->attributes['date']));
    }

    public function setDateAttribute($date)
    {
        $date = date('Y-m-d 00:00:00', strtotime($date));
        $this->attributes['date'] = $date;
    }

    public function count() {
        return $this->orders()->count();
    }
}
