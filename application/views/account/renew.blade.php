@layout('templates.rms')

@section('title')
    @parent - Renew Profile
@endsection

@section('content')
    {{ Form::open('rms/account/renew')}}

    <legend>Renew For Year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years )}}<br>


        {{ Form::submit('Save changes') }}
        {{ HTML::link('/rms/account','Cancel') }}



    {{ Form::close() }}
      
@endsection