@layout('templates.rms')

@section('title')
    @parent - Edit Executive Position
@endsection

@section('content')
    {{ Form::open('rms/executives/edit/' . $executive->id)}}

    <legend>Edit Executive Position</legend>

        {{ Form::label('position', 'Position') }}
        {{ Form::text('position',Input::old('position',$executive->position))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias',$executive->alias))}}<br>

        {{ Form::submit('Save changes', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/executives','Cancel', array('class'=>'btn')) }}


    {{ Form::close() }}
      
@endsection