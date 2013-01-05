<?php 

class Sponsor extends Eloquent {
	public static $timestamps = true;

    public function years()
    {
        return $this->has_many_and_belongs_to('Year');
    }

   
}
