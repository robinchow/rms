@layout('templates.rms')

@section('title')
    @parent - Join a team
@endsection

@section('content')
    {{ Form::open('rms/teams/join')}}

    <legend>Join a team</legend>

    	{{ Form::hidden('team_id',$team->id)}}

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years )}}<br>


        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/teams','Cancel') }}



    {{ Form::close() }}
      
@endsection