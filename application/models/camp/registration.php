<?php 

class Camp_Registration extends Eloquent {
	public static $timestamps = true;

   
	public function camp_setting()
	{
		return $this->belongs_to('Camp_Setting');
	}

	public function user()
	{
		return $this->belongs_to('User');
	}




}
