@layout('templates.rms_login')

@section('title')
    @parent - Forgot Password
@endsection



@section('content')
    {{ Form::open('rms/account/forgot') }}
        <h2>Forgot Password</h2>

        {{ Form::text('email','',array('class'=>'input-block-level','placeholder'=>'Email address' )) }}

        {{ Form::submit('Send me a reminder', array('class'=>'btn btn-large btn-primary')) }}
    {{ Form::close() }}
      
@endsection