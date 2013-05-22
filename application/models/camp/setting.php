<?php 

class Camp_Setting extends Eloquent {
	public static $timestamps = true;

   
	public function year()
	{
		return $this->belongs_to('Year');
	}

	public function registrations()
	{
		return $this->has_many('Camp_Registration');
	}

	public function get_remaining() {
		return $this->places - count($this->registrations);
	}

}
