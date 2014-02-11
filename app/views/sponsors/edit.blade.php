@layout('templates.rms')

@section('title')
    @parent - Edit Sponsor
@endsection

@section('content')
    {{ Form::open_for_files('rms/sponsors/edit/' . $sponsor->id)}}

    <legend>Edit Sponsor</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',Input::old('name',$sponsor->name))}}<br>

        {{ Form::label('image', 'Image') }}
        <img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/><br>
        {{ Form::file('image')}}<br>

        {{ Form::label('url', 'Website URL') }}
        {{ Form::text('url', Input::old('url',$sponsor->url))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/sponsors','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection