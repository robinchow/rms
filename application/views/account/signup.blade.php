@layout('templates.home')

@section('title')
    @parent - Sign Up
@endsection

@section('content')
    {{HTML::style('css/datepicker.css')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}
    <script type="text/javascript">
            $(function() {
                $('#dob').datepicker();
        });
    </script>
	<div class="row">

    <div class="span10 offset1" id="main-title">
    <h2>Join</h2>
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">
    {{ Form::open_for_files('rms/account/signup')}}
    <style>
        legend {
            border:0px;
            color:#08C;
        }
    </style>
     <fieldset style="padding:20px;">
        <legend>Account Details:</legend>
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email') }}

        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}


    </fieldset>

     <fieldset style="padding:20px;">
        <legend>Personal Details:</legend>
        {{ Form::label('image', 'Image') }}
        {{ Form::file('image')}}<br>

        {{ Form::label('full_name', 'Full Name') }}
        {{ Form::text('full_name')}}<br>

        {{ Form::label('display_name', 'Display Name') }}
        {{ Form::text('display_name')}}<br>

        {{ Form::label('dob', 'DOB') }}
    <div class="input-append date" id="dob" data-date="01-01-2000" data-date-format="dd-mm-yyyy">
        <input name="dob" class="span2" size="16" type="text" value="01-01-2000" readonly="">
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>

        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('O'=>'Other','M' => 'Male', 'F' => 'Female')) }}<br>

        </fieldset>

     <fieldset style="padding:20px;">
        <legend>Contact Details:</legend>
        {{ Form::label('phone', 'Phone') }}
        {{ Form::telephone('phone') }}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('privacy', 1)}} Hide My contact Details
        </label>
        </fieldset>

     <fieldset style="padding:20px;">
        <legend>University Details:</legend>
        {{ Form::label('university', 'University') }}
        {{ Form::text('university')}}<br>

        {{ Form::label('program', 'Program') }}
        {{ Form::text('program')}}<br>

        {{ Form::label('student_number', 'Student Number') }}
        {{ Form::text('student_number')}}<br>
        {{ Form::label('start_year', 'Start Year') }}
        {{ Form::date('start_year')}}<br>

        <label for="arc" class="checkbox">
            {{ Form::checkbox('arc', 1) }} ARC
        </label>
        </fieldset>

     <fieldset style="padding:0 20px;">
        {{ Form::submit('Signup', array('class'=>'btn btn-primary')) }}
    </fieldset>


    {{ Form::close() }}
  
@endsection
