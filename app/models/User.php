<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function profile() {
        return $this->hasOne('Profile');
    }

    public function years() {
        return $this->belongsToMany('Year')->orderBy('year', 'desc');
    }

    public function executives() {
        return $this->belongsToMany('Executive')->withPivot('year_id', 'non_executive');
    }

    public function teams() {
        return $this->belongsToMany('Team')->withPivot('year_id', 'status');
    }


    public function orders()
    {
        return $this->hasMany('MerchOrder');
    }

    public function wellbeing_orders()
    {
        return $this->hasMany('WellbeingOrder');
    }

    public function wellbeing_orders_year($year_id)
    {
        return DB::table('wellbeing_orders')
            ->where('year_id', '=', $year_id)
            ->where('user_id', '=', $this->id);
    }

    public function reset_url()
    {
        return URL::to('/rms/account/reset-password/'.$this->id.'/'.$this->reset_password_hash);
    }

    public function profile_url()
    {
        return URL::to('/rms/users/show/'.$this->id);
    }

    public function has_signed_up_for_camp()
    {
        $camp = CampSetting::where('year_id' , '=' , Year::current_year()->id);

        $count = DB::table('camp_registrations')
            ->where('camp_setting_id', '=', $camp->first()->id)
            ->where('user_id', '=', $this->id)->count();
        return $count!=0;
    }

    public function getImageUrlAttribute()
    {
        $url = URL::to('/img/profile/'.$this->profile->image);
        $file = base_path() . '/public/img/profile/'.$this->profile->image;
        if(!(File::exists($file) && in_array(File::extension($file), array('jpg','jpeg','gif','png')))) {
            if($this->profile->gender=='M'){
                $url = URL::to('/img/male.jpg');
            } else {
                $url = URL::to('/img/female.jpg');
            }
        }

        return $url;
    }


    public function getNeedsToRenewAttribute()
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

    // If you're a head of a team that's set to public, you should be on orgs
    public function is_on_orgs()
    {
        $teams = DB::table('teams')->where('privacy', '=', '0')->lists('id');
        foreach ($teams as $team) {
            $count = DB::table('team_user')->where('team_id', '=', $team)
                                        ->where('year_id', '=', Year::current_year()->id)
                                        ->where('status', '=', 'head')
                                        ->where('user_id', '=', $this->id)
                                        ->get();
            if(count($count) != 0) return true;
        }
        return false;
    }

    // only the secretary or a producer may add news items
    public function can_add_news()
    {
        return DB::table('executive_user')
            ->join('executives', 'executive_user.executive_id', '=', 'executives.id')
            ->join('years', 'years.id', '=', 'executive_user.year_id')
            ->where('executive_user.user_id', '=', $this->id)
            ->where('year_id', '=', Year::current_year()->id)
            ->whereIn('position', array('Producers', 'Secretary'))
            ->count();

    }

    public function is_part_of_team($year_id, $team_id)
    {
        $count = DB::table('team_user')->where('team_id', '=', $team_id)
                    ->where('year_id', '=', $year_id)
                    ->where('user_id', '=', $this->id)->count();
        return $count!=0;
    }

    public function can_manage_team($team_id)
    {
        if($this->admin || $this->is_currently_part_of_exec())
        {
            return true;
        }
        else
        {
            $team = Team::find($team_id);
            $result = $team->users()->where('users.id', '=', $this->id)
                                    ->where('status', '=', 'head')
                                    ->where('year_id','=',Year::current_year()->id)
                                    ->get();
            return count($result) != 0;
        }
    }

    public function can_edit_merch_orders()
    {
        return $this->admin || $this->is_currently_part_of_exec();
    }

    public function blog_posts(){
        return $this->hasMany('BlogPost', 'author_id');
    }
}
