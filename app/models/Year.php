<?php 

class Year extends Eloquent {
    
    protected $fillable = array('year', 'name', 'alias');
    
    public static function current_year() 
    {
        return Year::where('year', '=', Config::get('rms_config.current_year'))->first();
    }

    public function teams()
    {
        return $this->belongsToMany('Team');
    }

	public function users()
    {
        return $this->belongsToMany('User');
    }

    public function sponsors()
    {
        return $this->belongsToMany('Sponsor');
    }

    public function wellbeing_orders() 
    {
        return $this->has_many('Wellbeing_Order');
    }

    public function camp_settings()
    {
        return $this->hasMany('CampSetting');
    }

    public function camp_active() 
    {
        $camp = CampSetting::where('year_id' , '=' , $this->id)
                    ->where('visible', '=', 1)
                    ->count();


        return $camp !=0;
    }

    public function merch_orders() {
        return $this->hasMany('MerchOrder');
    }

    /* returns a list of the exec positions filled that year */
    public function executives()
    {
        $executives_id = DB::table('executive_user')->select('executive_id')->where('year_id', '=', $this->id)->get();
        $exec_id = array();
        foreach($executives_id as $e) {
            $exec_id[] = $e->executive_id;
        }

        if($exec_id!=null) {
            return Executive::whereIn('id',$exec_id)->get();

        } else {
            return array();
        }
    }

    public function producers()
    {

        $p_id = Executive::where('position','=','Producers')->first();

        $producers_joins = DB::table('executive_user')
            ->where('year_id', '=', $this->id)
            ->where('executive_id', '=', $p_id->id)
            ->where('non_executive', '=', false)
            ->get();
        
        $producers = array();
        foreach($producers_joins as $p) {
          $producers[] = User::find($p->user_id);
        }
  

        return $producers;
    }

    public function directors()
    {
        $d_id = Executive::where('position','=','Directors')->first()->id;

        $d_joins = DB::table('executive_user')
            ->where('year_id', '=', $this->id)
            ->where('executive_id', '=', $d_id)
            ->where('non_executive', '=', false)
            ->get();
        
        $directors = array();
        foreach($d_joins as $d) {
            $directors[] = User::find($d->user_id);
        }

        return $directors;    
    }

    public function getMailingListAttribute() 
    {
        return 'all.' . $this->alias . '@cserevue.org.au';
    }
}
