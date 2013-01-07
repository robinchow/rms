<?php 

class Team extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User')->with('year_id','status');
    }

    public function get_privacy_string()
	{
		return ($this->privacy ? 'Private' : 'Public');
	}

	public function get_mailing_list() 
	{
		return $this->alias . '@cserevue.org.au';
	}

	public function get_members($year_id, $status) 
	{
		$all_users = $this->users;
		$year_users = array();
		foreach($all_users as $user) 
		{
			if ($user->pivot->year_id == $year_id && $user->pivot->status == $status )
			{
				$year_users[] = $user;
			}
		}
		return $year_users;
	}

}
