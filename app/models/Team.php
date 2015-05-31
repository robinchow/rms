<?php 

class Team extends Eloquent {
    
    protected $fillable = array('name', 'alias', 'privacy', 'description');


    public static function all_active() 
    {
        return Year::current_year()->teams();
    }

    public function is_active() 
    {
        $result = Year::current_year()->teams()->where('teams.id', '=', $this->id)->get();
        return count($result) != 0;
    }

    public function users()
    {
        return $this->belongsToMany('User')->withPivot('year_id','status');
    }

    public function years()
    {
        return $this->belongsToMany('Year')->orderBy('year', 'desc');
    }

    public function getPrivacyStringAttribute()
    {
        return ($this->privacy ? 'Private' : 'Public');
    }

    public function getMailingListAttribute() 
    {
        return $this->alias . '@cserevue.org.au';
    }

    public function getHeadsEmailAttribute() 
    {
        return $this->alias . '.head@cserevue.org.au';
    }

    public function getInterestEmailAttribute() 
    {
        return $this->alias . '.interest@cserevue.org.au';
    }

    public function get_members($year_id, $status) 
    {
        $all_users = $this->users;
        $year_users = array();
        foreach($all_users as $user) 
        {
            if ($user->pivot->year_id == $year_id && $user->pivot->status == $status && $user->profile != null)
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

    public function get_user_status($user_id) {
        $user = DB::table('team_user')
            ->where('team_id', '=', $this->id)
            ->where('user_id', '=', $user_id)
            ->where('year_id', '=', Year::current_year()->id)
            ->first()
            ;

        $status = '';
        if ($user != NULL) {
            $status .= $user->status;
        }
        return $status;
    }

}
