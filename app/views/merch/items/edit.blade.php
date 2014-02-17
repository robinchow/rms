@extends('templates.rms')

@section('title')
    @parent - Edit Item
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/merch/items/edit/'. $item->id)) }}

    <legend>Edit Item</legend>
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title', $item->title))}}<br>

        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description',Input::old('description', $item->description))}}<br>

        {{ Form::label('price', 'Price') }}
        {{ Form::text('price',Input::old('price', $item->price))}}<br>

        <label for="has_size" class="checkbox">
            {{ Form::checkbox('has_size', 1,Input::old('has_size', $item->has_size) ) }} Has Sizes
        </label>

        <label for="active" class="checkbox">
            {{ Form::checkbox('active', 1,Input::old('active', $item->active) ) }} Active
        </label>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/items','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
