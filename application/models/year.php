<?php 

class Year extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User');
    }

    public function executives()
    {
        return $this->has_many_and_belongs_to('Executive','executive_user')->with('user_id','non_executive');
    }
}
