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

    public function reset_url()
    {
        return URL::base() . '/rms/account/reset_password/'.$this->id.'/'.$this->reset_password_hash;
    }
    

    public function get_needs_to_renew()
    {
        $year = Year::where('year','=',Config::get('rms_config.current_year'))->first();
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
            $membership  = DB::table('team_user')
                    ->where('team_id', '=', $team_id)
                    ->where('year_id', '=', $year_id)
                    ->where('user_id', '=', $this->id)
                    ->first();
            return $membership->status=="head";
        }
    }

}
