@extends('templates.rms')

@section('title')
    @parent - Showing Blog Post
@endsection

@section('content')

    <h3>{{$blog_posts->title}}</h3>

    <div>{{$blog_posts->body}} </div>

    {{HTML::link('rms/blog/posts/','Back',array('class'=>'btn'))}}
      
@endsection
