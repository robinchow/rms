@extends('templates.rms')

@section('title')
    @parent - Add a Blog Post
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/blog/posts/add')) }}

    <legend>Add a Blog Post</legend>

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title'))}}<br>

        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body',Input::old('body'))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/blog/posts','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
