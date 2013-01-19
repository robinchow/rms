@layout('templates.home')

@section('title')
    @parent - Signup Profile
@endsection

@section('content')

	<div class="row">

    <div class="span10 offset1" id="main-title">
    <h2>Signup User Profile</h2>
	</div>
	</div>

    <div class="row">

    <div class="span6 offset3" style="padding-left:20px;padding-right:20px" id="main-content">
    {{ Form::open_for_files('rms/account/signup')}}
    <style>
        legend {
            border:0px;
            color:#08C;
        }
    </style>
     <fieldset>
        <legend>Account Details:</legend>
        {{ Form::text('email','',array('placeholder'=>'Email address' )) }}
        <!-- password field -->
        {{ Form::password('password',array('placeholder'=>'Password')) }}


    </fieldset>

        <fieldset>
        <legend>Personal Details:</legend>
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image')}}<br>

        {{ Form::label('full_name', 'Full Name') }}
        {{ Form::text('full_name')}}<br>

        {{ Form::label('display_name', 'Display Name') }}
        {{ Form::text('display_name')}}<br>

        {{ Form::label('dob', 'DOB') }}
        {{ Form::date('dob')}}<br>

        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('O'=>'Other','M' => 'Male', 'F' => 'Female')) }}<br>

        </fieldset>

        <fieldset>
        <legend>Contact Details:</legend>
        {{ Form::label('phone', 'Phone') }}
        {{ Form::telephone('phone') }}<br>

        {{ Form::label('privacy', 'Privacy') }}
        {{ Form::checkbox('privacy', 1 ) }}<br>
        </fieldset>

        <fieldset>
        <legend>University Details:</legend>
        {{ Form::label('university', 'University') }}
        {{ Form::text('university')}}<br>

        {{ Form::label('program', 'Program') }}
        {{ Form::text('program')}}<br>

        {{ Form::label('student_number', 'Student Number') }}
        {{ Form::text('student_number')}}<br>
        {{ Form::label('start_year', 'Start Year') }}
        {{ Form::date('start_year')}}<br>

        {{ Form::label('arc', 'Arc') }}
        {{ Form::checkbox('arc', 1) }}<br>
        </fieldset>


        {{ Form::submit('Signup', array('class'=>'button')) }}
        {{ HTML::link('/rms/account','Cancel',array('class'=>'button')) }}



    {{ Form::close() }}
  
@endsection
