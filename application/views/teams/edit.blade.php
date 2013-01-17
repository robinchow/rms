@layout('templates.rms')

@section('title')
    @parent - Edit Team
@endsection

@section('content')
    {{ Form::open('rms/teams/edit/' . $team->id)}}

    <legend>Edit Team</legend>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', Input::old('name',$team->name))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias',$team->alias))}}<br>

        <label for="privacy" class="checkbox">
            {{ Form::checkbox('privacy', 1 , Input::old('privacy',$team->privacy)) }} Privacy
        </label>

		{{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', Input::old('description',$team->description))}}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/teams','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection