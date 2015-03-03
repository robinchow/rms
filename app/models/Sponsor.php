<?php

class Sponsor extends Eloquent {
	public $timestamps = true;
    protected $fillable = array('name', 'image', 'url', 'description');

    public function years()
    {
        return $this->belongsToMany('Year', 'sponsor_year')->withPivot('year_id', 'sponsor_level');
    }


}
