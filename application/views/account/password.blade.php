@layout('templates.rms')

@section('title')
    @parent - Change Password
@endsection

@section('content')
    {{ Form::open('rms/account/change_password')}}

    <legend>Change Password</legend>

    {{ Form::label('old_password', 'Old Password') }}
    {{ Form::password('old_password') }}<br>

    {{ Form::label('password', 'New Password') }}
    {{ Form::password('password') }}<br>
    {{ Form::label('confirm_password', 'Confirm New Password') }}
    {{ Form::password('confirm_password') }}<br>


    

    {{ Form::submit('Change') }}
    {{ Form::close() }}
      
@endsection