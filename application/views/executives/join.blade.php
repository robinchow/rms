@layout('templates.rms')

@section('title')
    @parent - Join a executive team
@endsection

@section('content')
    {{ Form::open('rms/executives/join')}}

    <legend>Join a Executive team</legend>


        {{ Form::label('executive_id', 'Executive Position') }}
        {{ Form::select('executive_id', $executives )}}<br>

        {{ Form::label('non_executive', 'Non Executive Position') }}
        {{ Form::checkbox('non_executive', 1 )}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/executives','Cancel') }}



    {{ Form::close() }}
      
@endsection