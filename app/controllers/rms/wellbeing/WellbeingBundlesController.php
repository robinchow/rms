<?php

class WellbeingBundlesController extends BaseController
{

    public $restful = true;

    public function __construct()
    {
        $this->beforeFilter('auth');
        $this->beforeFilter('exec', array('except'=>'show'));

    }


    public function get_index() {
        $bundles = WellbeingBundle::current_bundles()->orderBy('name')->get();
        return View::make('wellbeing.bundles.index')->with('bundles',$bundles);
    }

    public function get_add() {
        $years = Year::lists('year', 'id');
        return View::make('wellbeing.bundles.add')->with('years', $years);
    }
    public function post_add() {

        $input = Input::get();
        $rules = array(
            'year_id' => 'required',
            'name'    => 'required',
            'price'   => 'required'
        );

        $validation = Validator::make($input, $rules);

        if ($validation->passes()) {
            $bundle = new WellbeingBundle;
            $bundle->name = Input::get('name');
            $bundle->price = Input::get('price');
            $bundle->year_id = Input::get('year_id');
            $bundle->save();

            return Redirect::to('rms/wellbeing/bundles')
                ->with('success', 'Successfully Added New Bundle');
        } else {
            return Redirect::to('rms/wellbeing/bundles/add')
                ->withErrors($validation)
                ->withInput();
        }
    }

    public function get_delete($id)
    {
        WellbeingBundle::find($id)->delete();
        return Redirect::to('rms/wellbeing/bundles')
                ->with('success', 'Successfully Removed Bundle');
    }

    public function get_manage($id) {
        $bundle = WellbeingBundle::find($id);
        $all_nights = WellbeingNight::current_nights()->get();
        $nights = array();

        # TODO do this with sql
        foreach ($all_nights as $night) {
            $contains = false;
            foreach ($bundle->nights()->get() as $n) {
                if ($night->id == $n->id) {
                    $contains = true;
                    break;
                }
            }

            if (!$contains) {
                $nights[] = $night;
            }
        }
        
        return View::make('wellbeing.bundles.manage')
            ->with('bundle', $bundle)
            ->with('nights', $nights);
    }

    public function get_night_remove($bundle_id, $night_id) {
        $bundle = WellbeingBundle::find($bundle_id);
        $night = WellbeingNight::find($night_id);

        $bundle->nights()->detach($night);

        return Redirect::to('rms/wellbeing/bundles/manage/'.$bundle_id);
    }

    public function get_night_add($bundle_id, $night_id) {
        $bundle = WellbeingBundle::find($bundle_id);
        $night = WellbeingNight::find($night_id);
        $bundle->nights()->attach($night);
        return Redirect::to('rms/wellbeing/bundles/manage/'.$bundle_id);
    }

}
