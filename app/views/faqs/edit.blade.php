@extends('templates.rms')

@section('title')
    @parent - Edit faq
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/faqs/edit/' . $faq->id)) }}

    <legend>Edit faq</legend>

        {{ Form::label('question', 'Question') }}
        {{ Form::text('question', Input::old('question',$faq->question))}}<br>

        {{ Form::label('answer', 'Answer') }}
        {{ Form::textarea('answer', Input::old('answer',$faq->answer))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{HTML::link('rms/faqs/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection
