@layout('templates.rms')

@section('title')
    @parent - Edit Profile
@endsection

@section('content')
    {{HTML::style('css/datepicker.css')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}
    <script type="text/javascript">
            $(function() {
                $('#dob').datepicker();
        });
    </script>

    <h2>Edit User Profile</h2>

    {{ Form::open_for_files('rms/account/edit')}}
        <fieldset>
        <legend>Personal Details:</legend>

        {{ Form::label('image', 'Image') }}
        {{ Image::polaroid($user->image_url(), $user->profile->display_name,array('width'=>'100px','height'=>'100px')) }}
        <br>

        {{ Form::file('image')}}<br>

        {{ Form::label('full_name', 'Full Name') }}
        {{ Form::text('full_name', Input::old('full_name',$user->profile->full_name ))}}<br>

        {{ Form::label('display_name', 'Display Name') }}
        {{ Form::text('display_name', Input::old('display_name',$user->profile->display_name))}}<br>

        {{ Form::label('dob', 'DOB') }}

    <div class="input-append date" id="dob" data-date="{{Input::old('dob',$user->profile->dob)}}" data-date-format="dd-mm-yyyy">
        <input name="dob" class="span2" size="16" type="text" value="{{Input::old('dob',$user->profile->dob)}}" readonly="">
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>


        {{ Form::label('gender', 'Gender') }}
        {{ Form::select('gender', array('O'=>'Other','M' => 'Male', 'F' => 'Female'), Input::old('gender',$user->profile->gender)) }}<br>

        </fieldset>

        <fieldset>
        <legend>Contact Details:</legend>
        {{ Form::label('phone', 'Phone') }}
        {{ Form::telephone('phone', Input::old('phone',$user->profile->phone))}}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('privacy', 1 ,Input::old('privacy',$user->profile->privacy))}} Hide My contact Details
        </label>

        </fieldset>

        <fieldset>
        <legend>University Details:</legend>
        {{ Form::label('university', 'University') }}
        {{ Form::text('university', Input::old('university',$user->profile->university))}}<br>

        {{ Form::label('program', 'Program') }}
        {{ Form::text('program', Input::old('program',$user->profile->program))}}<br>

        {{ Form::label('student_number', 'Student Number') }}
        {{ Form::text('student_number', Input::old('student_number',$user->profile->student_number))}}<br>
        {{ Form::label('start_year', 'Start Year') }}
        {{ Form::text('start_year', Input::old('start_year',$user->profile->start_year))}}<br>


        <label for="arc" class="checkbox">
            {{ Form::checkbox('arc', 1 ,Input::old('arc',$user->profile->arc)) }} ARC
        </label>
        </fieldset>


        {{ Form::submit('Save changes', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/account','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
@endsection
