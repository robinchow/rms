<?php 

class Camp_Registration extends Eloquent {
	public static $timestamps = true;

   
	public function Camp_Setting()
	{
		return $this->belongs_to('Camp_Setting');
	}




}
