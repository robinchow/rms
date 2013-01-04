@layout('templates.rms')

@section('title')
    @parent - Edit faq
@endsection

@section('content')
    {{ Form::open('rms/faqs/edit/' . $faq->id)}}

    <legend>Edit faq</legend>

        {{ Form::label('question', 'Question') }}
        {{ Form::text('question', $faq->question)}}<br>

		{{ Form::label('answer', 'Answer') }}
        {{ Form::textarea('answer', $faq->answer)}}<br>

        {{ Form::submit('Save changes') }}
        {{HTML::link('rms/faqs/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection