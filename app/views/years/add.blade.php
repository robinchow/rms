@extends('templates.rms')

@section('title')
    @parent - Add New Year
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/years/add')) }}

    <legend>Add a new Year</legend>

        {{ Form::label('year', 'Year') }}
        {{ Form::text('year',Input::old('year'))}}<br>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',Input::old('name'))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias'))}}<br>

        {{ Form::submit('Save changes', array('class'=>'btn btn-primary'))}}
        {{ HTML::link('/rms/years','Cancel', array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection
