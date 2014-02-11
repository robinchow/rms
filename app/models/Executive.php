<?php

class Executive extends Eloquent {
    protected $fillable = array('position', 'alias');

	public function users()
    {
        return $this->belongsToMany('User')->withPivot('year_id', 'non_executive');
    }

    public function mailing_list($year = "_")
	{
        if ($year == "_" || $year == Year::current_year()->year) {
            $year_alias = "";
        } else {
            $year_alias = '.'.Year::where('year', '=', $year)->select('alias')->first()->alias;
        }


		return $this->alias . $year_alias . '@cserevue.org.au';
	}

    public function getMailingListAttribute()
    {
        return $this->alias.'@cserevue.org.au';
    }

	//Only "real exec"
	public function get_members($year_id)
	{
		$all_users = $this->users;
		$year_users = array();
		foreach($all_users as $user)
		{
			if ($user->pivot->year_id == $year_id && !$user->pivot->non_executive)
			{
				$year_users[] = $user;
			}
		}
		return $year_users;
	}

	public function get_non_members($year_id)
	{
		$all_users = $this->users;
		$year_users = array();
		foreach($all_users as $user)
		{
			if ($user->pivot->year_id == $year_id && $user->pivot->non_executive)
			{
				$year_users[] = $user;
			}
		}
		return $year_users;
	}

	public function get_all_members($year_id)
	{
		$all_users = $this->users;
		$year_users = array();
		foreach($all_users as $user)
		{
			if ($user->pivot->year_id == $year_id)
			{
				$year_users[] = $user;
			}
		}
		return $year_users;
	}


}
