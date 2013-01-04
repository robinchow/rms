@layout('templates.rms')

@section('title')
    @parent - Add faq
@endsection

@section('content')
    {{ Form::open('rms/faqs/add')}}

    <legend>add faq</legend>

        {{ Form::label('question', 'Question') }}
        {{ Form::text('question')}}<br>

		{{ Form::label('answer', 'Answer') }}
        {{ Form::textarea('answer')}}<br>

        {{ Form::submit('Save changes') }}
        {{HTML::link('rms/faqs/','Cancel',array('class'=>'btn'))}}



    {{ Form::close() }}
      
@endsection