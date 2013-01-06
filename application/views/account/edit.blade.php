@layout('templates.rms')

@section('title')
    @parent - Edit Profile
@endsection

@section('content')
    <h2>Edit User Profile</h2>

    {{ Form::open_for_files('rms/account/edit')}}
        <fieldset>
        <legend>Personal Details:</legend>
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image')}}<br>

        {{ Form::label('full_name', 'Full Name') }}
        {{ Form::text('full_name', $user->profile->full_name )}}<br>

        {{ Form::label('display_name', 'Display Name') }}
        {{ Form::text('display_name', $user->profile->display_name)}}<br>

        {{ Form::label('dob', 'DOB') }}
        {{ Form::date('dob', $user->profile->dob)}}<br>

        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('O'=>'Other','M' => 'Male', 'F' => 'Female'), $user->profile->gender) }}<br>

        </fieldset>

        <fieldset>
        <legend>Contact Details:</legend>
        {{ Form::label('phone', 'Phone') }}
        {{ Form::telephone('phone', $user->profile->phone)}}<br>

        {{ Form::label('privacy', 'Privacy') }}
        {{ Form::checkbox('privacy', 1 ,$user->profile->privacy) }}<br>
        </fieldset>

        <fieldset>
        <legend>University Details:</legend>
        {{ Form::label('university', 'University') }}
        {{ Form::text('university', $user->profile->university)}}<br>

        {{ Form::label('program', 'Program') }}
        {{ Form::text('program', $user->profile->program)}}<br>

        {{ Form::label('student_number', 'Student Number') }}
        {{ Form::text('student_number', $user->profile->student_number)}}<br>
        {{ Form::label('start_year', 'Start Year') }}
        {{ Form::date('start_year', $user->profile->start_year)}}<br>

        {{ Form::label('arc', 'Arc') }}
        {{ Form::checkbox('arc', 1 ,$user->profile->arc) }}<br>
        </fieldset>


        {{ Form::submit('Save changes', array('class'=>'button')) }}
        {{ HTML::link('/rms/account','Cancel',array('class'=>'button')) }}



    {{ Form::close() }}
@endsection