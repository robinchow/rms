@layout('templates.rms')

@section('title')
    @parent - Edit Registration For Camp
@endsection

@section('content')
    {{ Form::open('rms/camp/registrations/edit')}}

    <legend>Edit Registration for Camp</legend>
            <h4>Camp Details:</h4>
        Camp: {{$rego->camp_setting->year->year}}<br>
        Theme: {{$rego->camp_setting->theme}}<br>
        Places Remaining: {{$rego->camp_setting->remaining}}<br>
        Details:<br>
        {{nl2br($rego->camp_setting->details)}}<br>

        <b> You have signed up for camp</b><br>
        @if ($rego->paid) 
        <b>You have Paid</b>
        @else
        <b>You have NOT Paid</b>
        @endif
        <br>

    <hr>
        <h4>Personal Details:</h4>
        {{ Form::hidden('id',$rego->id)}}
        Full Name: {{ Auth::User()->profile->full_name }}<br>
        DOB: {{ Auth::User()->profile->dob }}<br>
        Phone: {{ Auth::User()->profile->number }}<br>
        Gender: {{ Auth::User()->profile->gender }}<br>
    <hr>
        <h4>Camp Related Details:</h4>
        <label for="medical" class="checkbox">
            {{ Form::checkbox('medical', 1,Input::old('medical', $rego->medical) ) }} Medical Conditions
        </label>

        {{ Form::label('medical_conditions', 'Medical Conditions') }}
        {{ Form::textarea('medical_conditions',Input::old('medical_conditions', $rego->medical_conditions))}}<br>

        <label for="dietary" class="checkbox">
            {{ Form::checkbox('dietary', 1,Input::old('dietary', $rego->dietary) ) }} Dietary Requirments
        </label>

        {{ Form::label('dietary_requirements', 'Dietary Requirements') }}
        {{ Form::textarea('dietary_requirements',Input::old('dietary_requirements', $rego->dietary_requirements))}}<br>


        <label for="car" class="checkbox">
            {{ Form::checkbox('car', 1,Input::old('car', $rego->car) ) }} Do You have a car
        </label>

        {{ Form::label('car_places', 'Car Places') }}
        {{ Form::text('car_places',Input::old('car_places', $rego->car_places))}}<br>

        {{ Form::label('leave_from', 'Leaving From') }}
        {{ Form::select('leave_from', array('Anywhere' => 'Anywhere', 'UNSW' => 'UNSW', 'Central' => 'Central', 'North Shore' => 'North Shore', 'Inner West' => 'Inner West' ) , Input::old('leave_from', $rego->leave_from) )}}

		{{ Form::label('song_requests', 'Song Requests') }}
        {{ Form::textarea('song_requests',Input::old('song_requests', $rego->song_requests))}}<br>



        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}

    {{ Form::close() }}
      
@endsection