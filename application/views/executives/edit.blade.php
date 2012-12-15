@layout('templates.rms')

@section('title')
    @parent - Edit executive position
@endsection

@section('content')
    {{ Form::open('rms/executives/edit/' . $executive->id)}}

    <legend>Add a new executive</legend>

        {{ Form::label('position', 'Position') }}
        {{ Form::text('position', $executive->position)}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',$executive->alias)}}<br>

        {{ Form::submit('Save changes') }}
        {{HTML::link('rms/executives/show/'. $executive->id,'Cancel',array('class'=>'button'))}}



    {{ Form::close() }}
      
@endsection