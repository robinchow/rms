@layout('templates.rms_login')

@section('title')
    @parent - Login
@endsection



@section('content')
    {{ Form::open('rms/account/login', 'POST') }}
        <h2>Sign In</h2>
        <!-- username field -->
        {{ Form::text('email','',array('class'=>'input-block-level','placeholder'=>'Email address' )) }}
        <!-- password field -->
        {{ Form::password('password',array('class'=>'input-block-level','placeholder'=>'Password')) }}

        <!-- submit button -->
        {{ Form::submit('Sign in', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/account/forgot','Forgot Password',array('class'=>'btn'))}}
    {{ Form::close() }}
@endsection