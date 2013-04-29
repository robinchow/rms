<?php 

class Team extends Eloquent {
	public static $timestamps = true;

    public static function all_active() 
    {
        return Year::current_year()->teams();
    }

    public function is_active() 
    {
        $result = Year::current_year()->teams()->where('teams.id', '=', $this->id)->get();
        return !empty($result);
    }

	public function users()
    {
        return $this->has_many_and_belongs_to('User')->with('year_id','status');
    }

    public function years()
    {
        return $this->has_many_and_belongs_to('Year')->order_by('year', 'desc');
    }

    public function get_privacy_string()
	{
		return ($this->privacy ? 'Private' : 'Public');
	}

	public function get_mailing_list() 
	{
		return $this->alias . '@cserevue.org.au';
	}

	public function get_heads_email() 
	{
		return $this->alias . '.head@cserevue.org.au';
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


    // Returns array of heads for this team by id
    public function get_heads($year_id) {
        return $this->has_many_and_belongs_to('User')
            ->with('year_id', 'status')
            ->where('status', '=', 'head')
            ->where('year_id', '=', $year_id);
    }

    public function get_heads_current() {
        return $this->get_heads(Year::current_year()->id);
    }

}
