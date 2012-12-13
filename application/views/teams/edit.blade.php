@layout('templates.rms')

@section('title')
    @parent - Edit Team
@endsection

@section('content')
    {{ Form::open('rms/teams/edit/' . $team->id)}}

    <legend>Add a new Team</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', $team->name)}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',$team->alias)}}<br>

        {{ Form::label('privacy', 'Privacy') }}
        {{ Form::checkbox('privacy', 1 , $team->privacy) }}<br>

		{{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', $team->description)}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/teams','Cancel') }}



    {{ Form::close() }}
      
@endsection