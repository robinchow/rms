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

}
