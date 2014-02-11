@layout('templates.rms')

@section('title')
    @parent - Add Sponsor to year
@endsection

@section('content')
    {{ Form::open('rms/sponsors/add_to_year/'.$sponsor->id)}}

    <legend>Add Sponsor to year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}<br>


        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/sponsors','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection