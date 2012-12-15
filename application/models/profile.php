<?php 

class Profile extends Eloquent {
	public static $timestamps = true;

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function get_privacy_string()
	{
		return ($this->privacy ? 'Yes' : 'No');
	}

	public function get_arc_string()
	{
		return ($this->arc ? 'Yes' : 'No');
	}

}
