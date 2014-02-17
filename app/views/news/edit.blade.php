@extends('templates.rms')

@section('title')
    @parent - Edit News Post
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/news/edit/' . $news->id)) }}

    <legend>Edit News Post</legend>

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title',$news->title))}}<br>

        {{ Form::label('post', 'Post') }}
        {{ Form::textarea('post',Input::old('post', $news->post))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{HTML::link('rms/news/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection
