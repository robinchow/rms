<?php 

class Camp_Setting extends Eloquent {
	public static $timestamps = true;

   
	public function year()
	{
		return $this->belongs_to('Year');
	}



}
