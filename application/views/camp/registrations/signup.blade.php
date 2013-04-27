@layout('templates.rms')

@section('title')
    @parent - Register For Camp
@endsection

@section('content')
    {{ Form::open('rms/camp/settings/add')}}

    <legend>Add New Camp</legend>
        {{ Form::label('camp_setting_id', 'Camp') }}
        {{ Form::select('camp_setting_id', $camps) }}<br>

        {{ Form::label('theme', 'Theme') }}
        {{ Form::text('theme',Input::old('theme'))}}<br>

        {{ Form::label('places', 'Places') }}
        {{ Form::text('places',Input::old('places'))}}<br>

		{{ Form::label('details', 'Details') }}
        {{ Form::textarea('details',Input::old('details'))}}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('visible', 1,Input::old('visible') ) }} Visible
        </label>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/camp/settings','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection