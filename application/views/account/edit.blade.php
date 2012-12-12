@layout('templates.rms')

@section('title')
    @parent - Edit Profile
@endsection

@section('content')
    {{ Form::open('rms/account/edit')}}

    <legend>Edit User Profile</legend>

        {{ Form::label('full_name', 'Full Name') }}
        {{ Form::text('full_name', $user->profile->full_name )}}<br>

        {{ Form::label('display_name', 'Display Name') }}
        {{ Form::text('display_name', $user->profile->display_name)}}<br>

        {{ Form::label('image', 'Image') }}
        {{ Form::text('image', $user->profile->image)}}<br>

        {{ Form::label('phone', 'Phone') }}
        {{ Form::text('phone', $user->profile->phone)}}<br>

        {{ Form::label('privacy', 'Privacy') }}
        {{ Form::checkbox('privacy', 'privacy') }}<br>

        {{ Form::label('dob', 'DOB') }}
        {{ Form::text('dob', $user->profile->dob)}}<br>



        {{ Form::label('university', 'University') }}
        {{ Form::text('university', $user->profile->university)}}<br>

        {{ Form::label('program', 'Program') }}
        {{ Form::text('program', $user->profile->program)}}<br>

        {{ Form::label('student_number', 'Student Number') }}
        {{ Form::text('student_number', $user->profile->student_number)}}<br>
        {{ Form::label('start_year', 'Start Year') }}
        {{ Form::text('start_year', $user->profile->start_year)}}<br>

        {{ Form::label('arc', 'Arc') }}
        {{ Form::checkbox('arc', $user->profile->arc) }}<br>

        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('?'=>':S','M' => 'Male', 'F' => 'Female'), $user->profile->gender) }}<br>



        {{ Form::submit('Save changes') }}
        {{ HTML::link('/account','Cancel') }}



    {{ Form::close() }}
      
@endsection