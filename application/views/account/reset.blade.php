@layout('templates.rms_login')

@section('title')
    @parent - Change Password
@endsection

@section('content')
    {{ Form::open('rms/account/reset_password')}}

    <legend>Reset Password</legend>

    {{ Form::hidden('id',$id) }}
    {{ Form::hidden('reset_password_hash',$reset_password_hash) }}


    {{ Form::label('password', 'New Password') }}
    {{ Form::password('password') }}<br>
    {{ Form::label('password_confirmation', 'Confirm New Password') }}
    {{ Form::password('password_confirmation') }}<br>


    

    {{ Form::submit('Change') }}
    {{ Form::close() }}
      
@endsection