@extends('templates.rms')

@section('title')
    @parent - Add a News Post
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/news/add')) }}

    <legend>Add a News Post</legend>

		{{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title'))}}<br>

		{{ Form::label('post', 'Post') }}
        {{ Form::textarea('post',Input::old('post'))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{HTML::link('rms/news/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection
