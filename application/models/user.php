<?php 

class User extends Eloquent {
	public static $timestamps = true;

    public static $hidden = array(
        'password',
        'reset_password_hash',
    );

	public function profile()
	{
		return $this->has_one('Profile');
	}

	public function teams()
    {
        return $this->has_many_and_belongs_to('Team')->with('year_id','status');
    }

    public function years()
    {
        return $this->has_many_and_belongs_to('Year')->order_by('year', 'desc');
    }

    public function executives()
    {
        return $this->has_many_and_belongs_to('Executive')->with('year_id','non_executive');
    }

    public function reset_url()
    {
        return URL::base() . '/rms/account/reset_password/'.$this->id.'/'.$this->reset_password_hash;
    }

    public function profile_url()
    {
        return URL::base() . '/rms/users/show/'.$this->id;
    }

    public function image_url()
    {
        $url = URL::base() . '/img/profile/'.$this->profile->image;
        $file = 'public/img/profile/'.$this->profile->image;
        if(!(File::exists($file) && File::is( array('jpg','gif','png'),  $file ))) {
            if($this->profile->gender=='M'){
                $url = URL::base() . '/img/male.jpg';
            } else {
                $url = URL::base() . '/img/female.jpg';
            }
        }

        return $url;
    }
    

    public function get_needs_to_renew()
    {
        $year = Year::current_year();
        $needs_to_renew = true;
        foreach ($this->years as $y)
        {
            if($y->id == $year->id) {
                $needs_to_renew = false;
            }
        }

        return $needs_to_renew;
    }

    public function is_part_of_exec($year_id, $executive_id)
    {
        $count = DB::table('executive_user')->where('executive_id', '=', $executive_id)
                    ->where('year_id', '=', $year_id)
                    ->where('user_id', '=', $this->id)->count();
        return $count!=0;
    }

    public function is_currently_part_of_exec()
    {
        $count = DB::table('executive_user')
                    ->where('year_id', '=', Year::current_year()->id)
                    ->where('user_id', '=', $this->id)->count();
        return $count!=0;
    }

    public function is_part_of_team($year_id, $team_id)
    {
        $count = DB::table('team_user')->where('team_id', '=', $team_id)
                    ->where('year_id', '=', $year_id)
                    ->where('user_id', '=', $this->id)->count();
        return $count!=0;
    }

    public function can_manage_team($year_id, $team_id)
    {
        if($this->admin)
        {
            return true;
        }
        else 
        {
            $team = Team::find($team_id);
            $result = $team->users()->where('users.id', '=', $this->id)
                                    ->where('status', '=', 'head')
                                    ->where('year_id','=',$year_id)
                                    ->get();
            return !empty($result);
        }
    }

}
