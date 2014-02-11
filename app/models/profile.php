<?php 

class Profile extends Eloquent {
	public static $timestamps = true;

    public function test() {
        return "Blah";
    }

	public function user()
	{
		return $this->belongs_to('User');
	}

	public function get_dob()
	{
	    return date('d-m-Y', strtotime($this->get_attribute('dob')));
	}

	public function set_dob($dob)
	{
		$dob = date('Y-m-d 00:00:00', strtotime($dob));
	    $this->set_attribute('dob', $dob);
	}

	public function get_start_year()
	{
	    return date('Y', strtotime($this->get_attribute('start_year')));
	}

	public function set_start_year($start_year)
	{
		$start_year = $start_year . '-01-01 00:00:00';
	    $this->set_attribute('start_year', $start_year);
	}

	public function get_privacy_string()
	{
		return ($this->privacy ? 'Yes' : 'No');
	}

	public function get_arc_string()
	{
		return ($this->arc ? 'Yes' : 'No');
	}

}
