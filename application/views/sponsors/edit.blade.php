@layout('templates.rms')

@section('title')
    @parent - edit sponsor
@endsection

@section('content')
    {{ Form::open_for_files('rms/sponsors/edit/' . $sponsor->id)}}

    <legend>Add a new sponsosr</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',$sponsor->name)}}<br>

        {{ Form::label('image', 'Image') }}
        <img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/>
        {{ Form::file('image')}}<br>

        {{ Form::label('url', 'url') }}
        {{ Form::text('url', $sponsor->url)}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/sponsors','Cancel') }}



    {{ Form::close() }}
      
@endsection