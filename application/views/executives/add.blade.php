@layout('templates.rms')

@section('title')
    @parent - Add New Executive
@endsection

@section('content')
    {{ Form::open('rms/executives/add')}}

    <legend>Add a new Executive Position</legend>

        {{ Form::label('position', 'Position') }}
        {{ Form::text('position')}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias')}}<br>


        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/executives','Cancel') }}



    {{ Form::close() }}
      
@endsection