@layout('templates.rms')

@section('title')
    @parent - Add sponsor to year
@endsection

@section('content')
    {{ Form::open('rms/sponsors/add_to_year/'.$sponsor->id)}}

    <legend>Add sponsor to year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}


        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/sponsors','Cancel') }}



    {{ Form::close() }}
      
@endsection