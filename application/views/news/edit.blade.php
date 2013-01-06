@layout('templates.rms')

@section('title')
    @parent - Edit news
@endsection

@section('content')
    {{ Form::open('rms/news/edit/' . $news->id)}}

    <legend>Edit news</legend>

		{{ Form::label('post', 'Post') }}
        {{ Form::textarea('post', $news->post)}}<br>

        {{ Form::submit('Save changes') }}
        {{HTML::link('rms/news/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection