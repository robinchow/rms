@extends('templates.rms')

@section('title')
    @parent - Change Password
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/account/change-password')) }}

    <legend>Change Password</legend>

    {{ Form::label('old_password', 'Old Password') }}
    {{ Form::password('old_password') }}<br>

    {{ Form::label('password', 'New Password') }}
    {{ Form::password('password') }}<br>

    {{ Form::label('password_confirmation', 'Confirm New Password') }}
    {{ Form::password('password_confirmation') }}<br>


    

    {{ Form::submit('Save Changes', array('class'=>'btn btn-primary')) }}
    {{ Form::close() }}
      
@endsection
