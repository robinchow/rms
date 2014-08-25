@extends('templates.rms')

@section('title')
    @parent - Add New Bundle
@endsection

@section('content')

    {{ Form::open(array('url'=>'rms/wellbeing/bundles/add')) }}

    <legend>Add New Bundle</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name'))}}<br>
        
        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years, Input::old('year_id', Year::current_year()->id)) }}<br>

        {{ Form::label('price', 'Price') }}
        $ {{ Form::text('price',Input::old('price'))}}<br>

        {{ Form::submit('Save Changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/nights','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}

@endsection
