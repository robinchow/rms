@extends('templates.rms')

@section('title')
    @parent - Register For Camp
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/camp/registrations/signup')) }}

    <legend>Register for Camp</legend>
    <h4>Camp Details:</h4>
        <strong>Camp:</strong> {{$camp->year->year}}<br>
        <strong>Theme:</strong> {{$camp->theme}}<br>
        <strong>Places Remaining:</strong> {{$camp->remaining}}<br>
        <strong>Details:</strong><br>
        {{nl2br($camp->details)}}<br>

    <hr>
        <h4>Personal Details:</h4>

        {{ Form::hidden('user_id',Auth::User()->id)}}
        {{ Form::hidden('camp_setting_id',$camp->id)}}

        Full Name: {{ Auth::User()->profile->full_name }}<br>
        DOB: {{ Auth::User()->profile->dob }}<br>
        Phone: {{ Auth::User()->profile->number }}<br>
        Gender: {{ Auth::User()->profile->gender }}<br>
    <hr>
        <h4>Camp Related Details:</h4>


        <label for="medical" class="checkbox">
            {{ Form::checkbox('medical', 1,Input::old('medical') ) }} Medical Conditions
        </label>

        {{ Form::label('medical_conditions', 'Medical Conditions') }}
        {{ Form::textarea('medical_conditions',Input::old('medical_conditions'))}}<br>

        <label for="dietary" class="checkbox">
            {{ Form::checkbox('dietary', 1,Input::old('dietary') ) }} Dietary Requirments
        </label>

        {{ Form::label('dietary_requirements', 'Dietary Requirements') }}
        {{ Form::textarea('dietary_requirements',Input::old('dietary_requirements'))}}<br>


        <label for="car" class="checkbox">
            {{ Form::checkbox('car', 1,Input::old('car') ) }} Do You have a car
        </label>

        {{ Form::label('car_places', 'Car Places') }}
        {{ Form::text('car_places',Input::old('car_places'))}}<br>

        {{ Form::label('leave_from', 'Leaving From') }}
        {{ Form::select('leave_from', array('Anywhere' => 'Anywhere', 'UNSW' => 'UNSW', 'Central' => 'Central', 'North Shore' => 'North Shore', 'Inner West' => 'Inner West' ) , Input::old('leave_from') )}}

        {{ Form::label('car_pool', 'Car Pooling') }}
        <p>If you have preference for who you want to be in your car on the way to camp, 
        <br>let us know and we'll do our best to accommodate your interests. 
        <br>Or if you're feeling lucky, leave this blank.</p>
        {{ Form::text('car_pool',Input::old('car_pool', $rego->car_pool))}}<br>
        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}

    {{ Form::close() }}
      
@endsection
