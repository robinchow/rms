@layout('templates.rms')

@section('title')
    @parent - Change Email
@endsection

@section('content')
    {{ Form::open('rms/account/change_email')}}

    <legend>Change Email</legend>

    {{ Form::label('old_email', 'Old Email') }}
    {{ Form::email('old_email') }}<br>

    {{ Form::label('email', 'New Email') }}
    {{ Form::email('email') }}<br>
    {{ Form::label('email_confirmation', 'Confirm New Email') }}
    {{ Form::email('email_confirmation') }}<br>


    

    {{ Form::submit('Change') }}
    {{ Form::close() }}
      
@endsection