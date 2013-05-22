<?php
class Rms_Camp_Registrations_Controller extends Base_Controller
{

    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'auth');
        $this->filter('before', 'admin')->except(array('signup', 'edit'));

    }

    public function get_index()
    {
        $camp = Camp_Setting::where('year_id', '=', Year::current_year()->id)->first();
        $regos = Camp_Registration::where('camp_setting_id', '=', $camp->id)->get();

        $arc_count = 0;
        foreach ($regos as $r) {
            if($r->user->profile->arc) {
                $arc_count++;
            }
        }

        $rego_paid = Camp_Registration::where('camp_setting_id', '=', $camp->id)
                        ->where('paid', '=',true)
                        ->get();

        $paid_count = count($rego_paid);


        $arc_paid_count = 0;
        foreach ($rego_paid as $r) {
            if($r->user->profile->arc) {
                $arc_paid_count++;
            }
        }

        $song_list = "";
        foreach ($regos as $r) {
            if ($song_list != "") {
                $song_list .= "<br/>";
            }
            $song_list .= $r->format_song_requests();
        }

        return View::make('camp.registrations.index')
                    ->with('regos',$regos)
                    ->with('arc_count',$arc_count)
                    ->with('paid_count',$paid_count)
                    ->with('arc_paid_count',$arc_paid_count)
                    ->with('song_list', $song_list);
    }

    public function get_signup()
    {
    	$camp = Camp_Setting::where('year_id', '=', Year::current_year()->id)->first();
        return View::make('camp.registrations.signup')->with('camp',$camp);
    }

    public function post_signup()
    {

        $input = Input::get();

        $rules = array(
            'user_id' => 'required|unique:camp_registrations',
            'camp_setting_id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);


        if($validation->passes())
        {
            $camp_reg = Camp_Registration::create(Input::get());

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Register for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/signup')
                ->with_errors($validation)
                ->with_input();
        }


    }

    public function get_edit()
    {
        $camp = Camp_Setting::where('year_id', '=', Year::current_year()->id)->first();
        $user = Auth::user();
        $rego = Camp_Registration::where('camp_setting_id', '=',$camp->id)
            ->where('user_id', '=',$user->id)->first();

        return View::make('camp.registrations.edit')->with('rego',$rego);
    }

    public function get_show($id)
    {

        $rego = Camp_Registration::find($id);
        return View::make('camp.registrations.show')->with('rego',$rego);
    }

    public function post_edit()
    {
        $input = Input::get();

        $rules = array(
            'id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);
        if($validation->passes())
        {
            $camp_reg = Camp_Registration::update(Input::get('id'), Input::get());

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Edited registration for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/edit')
                ->with_errors($validation)
                ->with_input();
        }

    }

    public function get_paid($id)
    {
        $rego = Camp_Registration::find($id);
        $rego->paid = true;
        $rego->save();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Marked Payment');
    }

    public function get_unpaid($id)
    {
        $rego = Camp_Registration::find($id);
        $rego->paid = false;
        $rego->save();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Un Marked Payment');
    }

    public function get_delete($id)
    {
        $rego = Camp_Registration::find($id)->delete();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Removed Camp Registration');
    }

}
