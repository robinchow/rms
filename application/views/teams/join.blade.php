@layout('templates.rms')

@section('title')
    @parent - Join a team
@endsection

@section('content')
    {{ Form::open('rms/teams/join')}}

    <legend>Join a team</legend>


        {{ Form::label('team_id', 'Team') }}
        {{ Form::select('team_id', $teams )}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/teams','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection