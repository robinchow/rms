@layout('templates.rms')

@section('title')
    @parent - Add New Year
@endsection

@section('content')
    {{ Form::open('rms/years/add')}}

    <legend>Add a new Year</legend>

        {{ Form::label('year', 'Year') }}
        {{ Form::text('year')}}<br>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name')}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias')}}<br>

        {{ Form::submit('Save changes', array('class'=>'btn btn-primary') }}
        {{ HTML::link('/rms/years','Cancel', array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection