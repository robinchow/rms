@layout('templates.rms')

@section('title')
    @parent - Renew Profile
@endsection

@section('content')
    {{ Form::open('rms/account/renew')}}

    <legend>Renew For Year</legend>
    	Click this if you would like to renew for {{$year->year}}
        {{ Form::submit('Renew') }}
        {{ HTML::link('/rms/account','Cancel') }}



    {{ Form::close() }}
      
@endsection