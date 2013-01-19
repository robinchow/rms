@layout('templates.rms')

@section('title')
    @parent - Change Email
@endsection

@section('content')
    {{ Form::open('rms/account/change_email')}}

    <legend>Change Email</legend>

    {{ Form::label('old_email', 'Old Email') }}
    {{ Form::email('old_email', Input::old('old_email')) }}<br>

    {{ Form::label('email', 'New Email') }}
    {{ Form::email('email', Input::old('email')) }}<br>
    {{ Form::label('email_confirmation', 'Confirm New Email') }}
    {{ Form::email('email_confirmation', Input::old('email_confirmation')) }}<br>


    

    {{ Form::submit('Save Changes', array('class'=>'btn btn-primary')) }}
    {{ Form::close() }}
      
@endsection