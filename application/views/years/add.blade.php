@layout('templates.rms')

@section('title')
    @parent - Add New Year
@endsection

@section('content')
    {{ Form::open('rms/years/add')}}

    <legend>Add a new Year</legend>

        {{ Form::label('year', 'Year') }}
        {{ Form::text('year')}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias')}}<br>

        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/years','Cancel') }}



    {{ Form::close() }}
      
@endsection