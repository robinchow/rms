@layout('templates.rms')

@section('title')
    @parent - Add New Team
@endsection

@section('content')
    {{ Form::open('rms/teams/add')}}

    <legend>Add a new Team</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name')}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias')}}<br>

        {{ Form::label('privacy', 'Privacy') }}
        {{ Form::checkbox('privacy', 1 ) }}<br>

		{{ Form::label('description', 'Description') }}
        {{ Form::textarea('description')}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/teams','Cancel') }}



    {{ Form::close() }}
      
@endsection