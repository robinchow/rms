@layout('templates.rms')

@section('title')
    @parent - Edit Year
@endsection

@section('content')
    {{ Form::open('rms/years/edit/' . $year->id)}}

    <legend>Add a new Year</legend>

        {{ Form::label('year', 'Year') }}
        {{ Form::text('year', $year->year)}}<br>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',$year->name)}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',$year->alias)}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/years','Cancel') }}



    {{ Form::close() }}
      
@endsection