@layout('templates.rms')

@section('title')
    @parent - Login
@endsection



@section('content')
    {{ Form::open('rms/account/login', 'POST') }}
        <h2>Please sign in</h2>
        <!-- check for login errors flash var -->
        @if (Session::has('login_errors'))
            <span class="error">Email or password incorrect.</span>
        @endif
        <!-- username field -->
        {{ Form::text('email','',array('class'=>'input-block-level','placeholder'=>'Email address' )) }}
        <!-- password field -->
        {{ Form::password('password',array('class'=>'input-block-level','placeholder'=>'Password')) }}

        <!-- submit button -->
        {{ Form::submit('Sign in', array('class'=>'btn btn-large btn-primary')) }}
    {{ Form::close() }}
      
@endsection