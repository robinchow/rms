<?php 

class Year extends Eloquent {
	public static $timestamps = true;

	public function users()
    {
        return $this->has_many_and_belongs_to('User');
    }

    public function sponsors()
    {
        return $this->has_many_and_belongs_to('Sponsor');
    }

    //Dont know if this is dodgy
    public function executives()
    {
        $executives_id = DB::table('executive_user')->where('year_id', '=', $this->id)->get('executive_id');
        $exec_id = array();
        foreach($executives_id as $e) {
            $exec_id[] = $e->executive_id;
        }

        $executives = Executive::where_in('id',$exec_id)->get();

        return $executives;
    }

    public function producers()
    {

        $p_id = Executive::where('position','=','Producer')->first();

        $producers_joins = DB::table('executive_user')
            ->where('year_id', '=', $this->id)
            ->where('executive_id', '=', $p_id->id)
            ->where('non_executive', '=', false)
            ->get();
        
        $producers_id = array();
        foreach($producers_joins as $p) {
            $producers_id[] = (int)$p->user_id;
        }

        $producers = User::where_in('id',array(1))->get();   

        return var_dump($producers);
    }

    public function directors()
    {
        return 'the directors';     
    }
}
