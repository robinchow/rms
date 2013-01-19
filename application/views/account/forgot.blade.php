@layout('templates.rms_login')

@section('title')
    @parent - Forgot Password
@endsection



@section('content')
    {{ Form::open('rms/account/forgot') }}
        <h2>Forgot Password</h2>

        {{ Form::text('email','',array('class'=>'input-block-level','placeholder'=>'Email address' )) }}

        {{ Form::submit('Reset my password', array('class'=>'btn btn-primary')) }}
    {{ Form::close() }}
      
@endsection