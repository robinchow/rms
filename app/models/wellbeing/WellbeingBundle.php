<?php

class WellbeingBundle extends Eloquent {

    protected $fillable = array('name', 'year_id', 'price');

    public static function current_bundles()
    {
        return WellbeingBundle::where('year_id', '=', Year::current_year()->id);
    }

    public function year()
    {
        return $this->belongsTo('Year');
    }

    public function nights()
    {
        return $this->belongsToMany('WellbeingNight', 'wellbeing_bundle_night', 'wellbeing_bundle_id', 'wellbeing_night_id');
    }
    

}
