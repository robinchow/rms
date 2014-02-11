<?php 

class Executive extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User')->with('year_id','non_executive');
    }

    public function get_mailing_list() 
	{
		return $this->alias . '@cserevue.org.au';
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