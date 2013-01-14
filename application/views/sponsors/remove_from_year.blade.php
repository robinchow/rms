@layout('templates.rms')

@section('title')
    @parent - Remove sponsor from year
@endsection

@section('content')
    {{ Form::open('rms/sponsors/remove_from_year/'.$sponsor->id)}}

    <legend>Remove sponsor from year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}<br>


        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/sponsors','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection