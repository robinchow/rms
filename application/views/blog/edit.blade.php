@layout('templates.rms')

@section('title')
    @parent - Edit Blog Post
@endsection

@section('content')
    {{ Form::open('rms/blog/posts/edit/' . $blog_posts->id)}}

    <legend>Edit Blog Post</legend>

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title',$blog_posts->title))}}<br>

        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body',Input::old('post', $blog_posts->body))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{HTML::link('rms/blog/posts/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection