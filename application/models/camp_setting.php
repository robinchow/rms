<?php 

class Camp_Setting extends Eloquent {
	public static $timestamps = true;

   
	public function year()
	{
		return $this->has_one('Year');
	}



}
