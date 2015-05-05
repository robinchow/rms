<?php

class CampRegistration extends Eloquent {

    protected $fillable = array('camp_setting_id', 'user_id', 'medical', 'medical_conditions', 
                                'dietary', 'dietary_requirements', 'car', 'car_places',
                                'leave_from', 'song_requests', 'paid', 'car_pool');

	public function camp_setting()
	{
		return $this->belongsTo('CampSetting');
	}

    public function getCampSettingAttribute() {
        return $this->camp_setting()->first();
    }

	public function user()
	{
		return $this->belongsTo('User');
	}


    public function format_song_requests()
    {
        return join("<br/>", explode("\n", $this->song_requests));
    }
}
