<?php 

class User extends Eloquent {
	public static $timestamps = true;

	public function profile()
	{
		return $this->has_one('Profile');
	}

	public function teams()
    {
        return $this->has_many_and_belongs_to('Team');
    }

    public function years()
    {
        return $this->has_many_and_belongs_to('Year');
    }

    public function executives()
    {
        return $this->has_many_and_belongs_to('Executive');
    }

}
