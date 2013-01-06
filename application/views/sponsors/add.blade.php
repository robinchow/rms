@layout('templates.rms')

@section('title')
    @parent - Add New sponsor
@endsection

@section('content')
    {{ Form::open_for_files('rms/sponsors/add')}}

    <legend>Add a new sponsosr</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name')}}<br>

        {{ Form::label('image', 'image') }}
        {{ Form::file('image')}}<br>

        {{ Form::label('url', 'url') }}
        {{ Form::text('url')}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/sponsors','Cancel') }}



    {{ Form::close() }}
      
@endsection