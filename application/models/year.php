<?php 

class Year extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User');
    }

    public function sponsors()
    {
        return $this->has_many_and_belongs_to('Sponsor');
    }

    //Dont know if this is dodgy
    public function executives()
    {
        return $this->has_many_and_belongs_to('Executive','executive_user')->with('user_id','non_executive');
    }

    public function producers()
    {
        return 'the producers';
    }

    public function directors()
    {
        return 'the directors';     
    }
}
