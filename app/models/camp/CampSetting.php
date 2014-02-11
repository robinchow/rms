<?php

class CampSetting extends Eloquent {

    protected $fillable = array('year_id', 'places', 'theme', 'details', 'visible');


	public function year()
	{
		return $this->belongsTo('Year');
	}

	public function registrations()
	{
		return $this->hasMany('CampRegistration');
	}

	public function getRemainingAttribute() {
		return $this->places - count($this->registrations);
	}

}
