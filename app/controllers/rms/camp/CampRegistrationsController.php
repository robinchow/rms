<?php
class CampRegistrationsController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('signed_up_for_camp', array('only' => 'get_signup'));
        $this->beforeFilter('orgs', array('except' => array('get_signup', 'post_signup', 'get_edit', 'post_edit')));
    }

    public function get_index()
    {
        $camp = CampSetting::where('year_id', '=', Year::current_year()->id)->first();
        $regos = CampRegistration::where('camp_setting_id', '=', $camp->id)->get();

        $arc_count = 0;
        foreach ($regos as $r) {
            if($r->user->profile->arc) {
                $arc_count++;
            }
        }

        $rego_paid = CampRegistration::where('camp_setting_id', '=', $camp->id)
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
        $song_list_a = explode("<br/>", $song_list);
        $song_list = "";
        foreach ($song_list_a as $s) {
            if (!ctype_space($s) && $s != "") {
                if ($song_list != "") {
                    $song_list .= "<br/>";
                }
                $song_list .= $s;
            }
        }

        return View::make('camp.registrations.index')
                    ->with('regos',$regos)
                    ->with('arc_count',$arc_count)
                    ->with('paid_count',$paid_count)
                    ->with('arc_paid_count',$arc_paid_count);
    }

    public function get_signup()
    {
        $camp = CampSetting::where('year_id', '=', Year::current_year()->id)->first();
        return View::make('camp.registrations.signup')->with('camp',$camp);
    }

    public function post_signup()
    {

        $input = Input::get();
        $year = Year::current_year()->id;
        $camp_setting_id = Input::get('camp_setting_id');;
        $rules = array(
            'user_id' => "required|unique:camp_registrations,user_id,NULL,id,camp_setting_id,$camp_setting_id",
            'camp_setting_id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);


        if($validation->passes())
        {
            $camp_reg = CampRegistration::create(Input::get());

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Register for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/signup')
                ->withErrors($validation)
                ->withInput();
        }
    }

    public function get_edit()
    {
        $camp = CampSetting::where('year_id', '=', Year::current_year()->id)->first();
        $user = Auth::user();
        $rego = CampRegistration::where('camp_setting_id', '=',$camp->id)
            ->where('user_id', '=',$user->id)->first();

        return View::make('camp.registrations.edit')->with('rego',$rego);
    }

    public function get_show($id)
    {

        $rego = CampRegistration::find($id);
        return View::make('camp.registrations.show')->with('rego',$rego);
    }

    public function post_edit()
    {
        $input = Input::get();

        $camp = CampSetting::where('year_id' , '=' , Year::current_year()->id);

        $camp_reg = DB::table('camp_registrations')
            ->where('camp_setting_id', '=', $camp->first()->id)
            ->where('user_id', '=', Auth::user()->id);

        $rules = array(
            'id' => 'required',
            'car_places' => 'integer',
        );

        $validation = Validator::make($input, $rules);
        if($validation->passes())
        {
            $camp_reg->update(Input::except('_token'));

            return Redirect::to('rms/camp/registrations/edit')
                ->with('success', 'Successfully Edited registration for Camp');
        }
        else
        {
            return Redirect::to('rms/camp/registrations/edit')
                ->withErrors($validation)
                ->withInput();
        }

    }

    public function get_paid($id)
    {
        $rego = CampRegistration::find($id);
        $rego->paid = true;
        $rego->save();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Marked Payment');
    }

    public function get_unpaid($id)
    {
        $rego = CampRegistration::find($id);
        $rego->paid = false;
        $rego->save();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Un Marked Payment');
    }

    public function get_delete($id)
    {
        $rego = CampRegistration::find($id)->delete();
        return Redirect::to('rms/camp/registrations')
                ->with('success', 'Successfully Removed Camp Registration');
    }
}
