@layout('templates.rms')

@section('title')
    @parent - Remove sponsor from year
@endsection

@section('content')
    {{ Form::open('rms/sponsors/remove_from_year/'.$sponsor->id)}}

    <legend>Remove sponsor from year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}


        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/sponsors','Cancel') }}



    {{ Form::close() }}
      
@endsection