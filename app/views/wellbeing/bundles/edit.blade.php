@extends('templates.rms')

@section('title')
    @parent - Edit Bundle
@endsection

@section('content')

    {{ Form::open(array('url'=>'rms/wellbeing/bundles/edit/' . $bundle->id)) }}

    <legend>Edit Bundle</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name', $bundle->name))}}<br>
        
        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years, Input::old('year_id', $bundle->year_id)) }}<br>

        {{ Form::label('price', 'Price') }}
        $ {{ Form::text('price',Input::old('price', $bundle->price))}}<br>

        {{ Form::submit('Save Changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/nights','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}

@endsection
