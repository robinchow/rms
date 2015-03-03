@extends('templates.rms')

@section('title')
    @parent - Add New Sponsor
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/sponsors/add','files'=>true)) }}

    <legend>Add a New Sponsor</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'))}}<br>

        {{ Form::label('image', 'Image') }}
        {{ Form::file('image')}}<br>

        {{ Form::label('url', 'Website Url') }}
        {{ Form::text('url',Input::old('url'))}}<br>

        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description') }}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/sponsors','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
