@extends('templates.home')

@section('title')
    @parent - Sign Up
@endsection

@section('content')
    {{HTML::style('css/datepicker.css')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}
    <script type="text/javascript">
            $(function() {
                $('#dob').datepicker({
                    format: 'dd-mm-yyyy'
                });
        });
    </script>
    <div class="row">

    <div class="span10 offset1" id="main-title">
    <h2>Join</h2>
    </div>
    </div>

    <div class="row">

    <div class="span10 offset1" id="main-content">
    {{ Form::open(array('url' => 'rms/account/signup', 'files'=>true, 'class'=>'form-horizontal')) }}
    <style>
        legend {
            border:0px;
            color:#08C;
        }
    </style>
     <fieldset>
        <legend style="padding:20px 0 0 20px;">Account Details:</legend>

        <div class="control-group {{ $errors->has('email') ? 'error' : '' }}">
            {{ Form::label('email', 'Email', array('class'=>'control-label')) }}
            <div class="controls">
                {{ Form::text('email', Input::old('email')) }}
                @if ($errors->has('email'))
                     {{ $errors->first('email', ' <span class="help-inline">:message</span>')}}
                @endif
            </div>
        </div>


        <div class="control-group {{ $errors->has('password') ? 'error' : '' }}">
            {{ Form::label('password', 'Password', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::password('password') }}
            @if ($errors->has('password'))
                {{ $errors->first('password', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>


    </fieldset>

     <fieldset>
        <legend style="padding:20px 0 0 20px;">Personal Details:</legend>

        <div class="control-group {{ $errors->has('image') ? 'error' : '' }}">
            {{ Form::label('image', 'Image', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::file('image')}}
            @if ($errors->has('image'))
                {{ $errors->first('image', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('full_name') ? 'error' : '' }}">
            {{ Form::label('full_name', 'Full Name', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::text('full_name', Input::old('full_name'))}}
            @if ($errors->has('full_name'))
                {{ $errors->first('full_name', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('display_name') ? 'error' : '' }}">
            {{ Form::label('display_name', 'Display Name', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::text('display_name', Input::old('display_name'))}}
            @if ($errors->has('display_name'))
                {{ $errors->first('display_name', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('dob') ? 'error' : '' }}">
            {{ Form::label('dob', 'DOB', array('class'=>'control-label')) }}
            <div class="controls">
                <input id="dob" name="dob" class="span2" size="16" type="text" value="{{Input::old('dob','01-01-2000')}}">
            @if ($errors->has('dob'))
                {{ $errors->first('dob', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>


        <div class="control-group {{ $errors->has('gender') ? 'error' : '' }}">
            {{ Form::label('gender', 'Gender', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::select('gender', array('O'=>'Other','M' => 'Male', 'F' => 'Female'), Input::old('gender')) }}<br>
            @if ($errors->has('gender'))
                {{ $errors->first('gender', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

    </fieldset>

     <fieldset style="padding:20px;">
        <legend>Contact Details:</legend>

        <div class="control-group {{ $errors->has('phone') ? 'error' : '' }}">
            {{ Form::label('phone', 'Phone', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::text('phone', Input::old('phone')) }}
            @if ($errors->has('phone'))
                {{ $errors->first('phone', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('privacy') ? 'error' : '' }}">
            {{ Form::label('privacy', 'Privacy', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::checkbox('privacy', 1, Input::old('privacy')) }}
            @if ($errors->has('privacy'))
                {{ $errors->first('privacy', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>


        </fieldset>

     <fieldset>
        <legend style="padding:20px 0 0 20px;">University Details:</legend>

        <div class="control-group {{ $errors->has('university') ? 'error' : '' }}">
            {{ Form::label('university', 'University', array('class'=>'control-label')) }}
            <div class="controls">
            @if(Input::old('university') == '')
                {{ Form::text('university', "UNSW" )}}
            @else
                {{ Form::text('university', Input::old('university') )}}
            @endif
            @if ($errors->has('university'))
                {{ $errors->first('university', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('program') ? 'error' : '' }}">
            {{ Form::label('program', 'Program', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::text('program', Input::old('program'))}}
            @if ($errors->has('program'))
                {{ $errors->first('program', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('student_number') ? 'error' : '' }}">
            {{ Form::label('student_number', 'Student Number', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::text('student_number', Input::old('student_number'))}}
            @if ($errors->has('student_number'))
                {{ $errors->first('student_number', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('start_year') ? 'error' : '' }}">
            {{ Form::label('start_year', 'Start Year', array('class'=>'control-label')) }}
            <div class="controls">
            @if(Input::old('university') == '')
                {{ Form::text('start_year', Year::current_year()->year ) }}
            @else
                {{ Form::text('start_year', Input::old('start_year')) }}
            @endif
            @if ($errors->has('start_year'))
                {{ $errors->first('start_year', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

        <div class="control-group {{ $errors->has('arc') ? 'error' : '' }}">
            {{ Form::label('arc', 'ARC', array('class'=>'control-label')) }}
            <div class="controls">
            {{ Form::checkbox('arc', 1, Input::old('arc')) }}
            @if ($errors->has('arc'))
                {{ $errors->first('arc', ' <span class="help-inline">:message</span>')}}
            @endif
            </div>
        </div>

    </fieldset>

    <div class="control-group">
        <div class="controls">
            {{ Form::submit('Signup', array('class'=>'btn btn-primary')) }}
        </div>
    </div>

    {{ Form::close() }}

@endsection
