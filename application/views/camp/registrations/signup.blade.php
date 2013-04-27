@layout('templates.rms')

@section('title')
    @parent - Register For Camp
@endsection

@section('content')
    {{ Form::open('rms/camp/registrations/signup')}}

    <legend>Add New Camp</legend>
        {{ Form::label('camp_setting_id', 'Camp') }}
        {{ Form::select('camp_setting_id', $camps) }}<br>

        <!--user Details-->
        {{ Form::hidden('user_id',Auth::User()->id)}}<br>



        <label for="medical" class="checkbox">
            {{ Form::checkbox('medical', 1,Input::old('medical') ) }} Medical Conditions
        </label>

        {{ Form::label('medical_conditions', 'Medical Conditions') }}
        {{ Form::textarea('medical_conditions',Input::old('medical_conditions'))}}<br>

        <label for="dietary" class="checkbox">
            {{ Form::checkbox('dietary', 1,Input::old('dietary') ) }} Dietary Requirments
        </label>

        {{ Form::label('dietary_requirments', 'Dietary Requirments') }}
        {{ Form::textarea('dietary_requirments',Input::old('dietary_requirments'))}}<br>


        {{ Form::label('places', 'Places') }}
        {{ Form::text('places',Input::old('places'))}}<br>

        {{ Form::label('places', 'Places') }}
        {{ Form::text('places',Input::old('places'))}}<br>

		{{ Form::label('song_requests', 'Song Requests') }}
        {{ Form::textarea('song_requests',Input::old('song_requests'))}}<br>



        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/camp/registrations','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection