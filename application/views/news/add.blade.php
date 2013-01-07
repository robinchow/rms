@layout('templates.rms')

@section('title')
    @parent - Add news post
@endsection

@section('content')
    {{ Form::open('rms/news/add')}}

    <legend>add news</legend>

		{{ Form::label('title', 'Title') }}
        {{ Form::textarea('title')}}<br>

		{{ Form::label('post', 'Post') }}
        {{ Form::textarea('post')}}<br>

        {{ Form::submit('Save changes') }}
        {{HTML::link('rms/news/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection