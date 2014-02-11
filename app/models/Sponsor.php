<?php

class Sponsor extends Eloquent {
	public $timestamps = true;
    protected $fillable = array('name', 'image', 'url');

    public function years()
    {
        return $this->belongsToMany('Year');
    }


}
