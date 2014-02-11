<?php 

class Profile extends Eloquent {

    protected $fillable = array('full_name', 'display_name', 'gender', 'dob',
                                'image', 'privacy', 'phone', 'university',
                                'program', 'student_number', 'start_year',
                                'arc');

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function getDobAttribute()
	{
	    return date('d-m-Y', strtotime($this->attributes['dob']));
	}

	public function setDobAttribute($dob)
	{
		$dob = date('Y-m-d 00:00:00', strtotime($dob));
	    $this->attributes['dob'] = $dob;
	}

	public function getStartYearAttribute()
	{
	    return date('Y', strtotime($this->attributes['start_year']));
	}

	public function setStartYearAttribute($start_year)
	{
		$start_year = $start_year . '-01-01 00:00:00';
	    $this->attributes['start_year'] = $start_year;
	}

	public function getPrivacyString()
	{
		return ($this->privacy ? 'Yes' : 'No');
	}

	public function getArcStringAttribute()
	{
		return ($this->arc ? 'Yes' : 'No');
	}

}
