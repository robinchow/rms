@extends('templates.rms')

@section('title')
    @parent - Add New Team
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/teams/add')) }}

    <legend>Add New Team</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',Input::old('name'))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias'))}}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('privacy', 1,Input::old('privacy') ) }} Privacy
        </label>

        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description',Input::old('description'))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/teams','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
