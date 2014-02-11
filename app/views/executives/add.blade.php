@extends('templates.rms')

@section('title')
    @parent - Add New Executive Position
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/executives/add')) }}

    <legend>Add New Executive Position</legend>

        {{ Form::label('position', 'Position') }}
        {{ Form::text('position',Input::old('position'))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias'))}}<br>


        {{ Form::submit('Save changes', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/executives','Cancel', array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection
