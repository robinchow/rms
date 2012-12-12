<?php 

class Profile extends Eloquent {
	public static $timestamps = true;

	public function profile()
	{
		return $this->belongs_to('Profile');
	}

}
