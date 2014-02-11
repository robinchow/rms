@extends('templates.rms')

@section('title')
    @parent - Add a New FAQ
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/faqs/add')) }}

    <legend>Add a New FAQ</legend>

        {{ Form::label('question', 'Question') }}
        {{ Form::text('question',Input::old('question'))}}<br>

		{{ Form::label('answer', 'Answer') }}
        {{ Form::textarea('answer',Input::old('answer'))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{HTML::link('rms/faqs/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection
