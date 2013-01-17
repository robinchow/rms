@layout('templates.rms')

@section('title')
    @parent - Join an Executive Position
@endsection

@section('content')
    {{ Form::open('rms/executives/join')}}

    <legend>Join an Executive Position</legend>


        {{ Form::label('executive_id', 'Executive Position') }}
        {{ Form::select('executive_id', $executives )}}<br>

        <label for="non_executive" class="checkbox">
            {{ Form::checkbox('non_executive', 1 )}} Non Executive/Assitant
        </label>
        
        {{ Form::submit('Save changes', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/executives','Cancel', array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection