@layout('templates.rms')

@section('title')
    @parent - Edit Camp
@endsection

@section('content')
    {{ Form::open('rms/camp/settings/edit/'. $camp->id)}}

    <legend>Edit Camp</legend>
        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years, Input::old('year_id',$camp->year->id)) }}<br>

        {{ Form::label('theme', 'Theme') }}
        {{ Form::text('theme',Input::old('theme',$camp->theme))}}<br>

        {{ Form::label('places', 'Places') }}
        {{ Form::text('places',Input::old('places', $camp->theme))}}<br>

		{{ Form::label('details', 'Details') }}
        {{ Form::textarea('details',Input::old('details', $camp->details))}}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('visible', 1,Input::old('visible', $camp->visible) ) }} Visible
        </label>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/camp/settings','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection