@extends('templates.rms')

@section('title')
    @parent - Add New Camp
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/camp/settings/add')) }}

    <legend>Add New Camp</legend>
        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}<br>

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
