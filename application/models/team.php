<?php 

class Team extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User');
    }

    public function get_privacy_string()
	{
		return ($this->privacy ? 'Private' : 'Public');
	}

	public function get_mailing_lists() 
	{
		$alias =  explode( ',', $this->alias);
		$mailing = array();
		foreach($alias as $a ) {
			$mailing[] = $a . '@cserevue.org.au';
		}
		return implode('<br>', $mailing);
	}

}
