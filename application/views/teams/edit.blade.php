@layout('templates.rms')

@section('title')
    @parent - Edit Team
@endsection

@section('content')
    {{ Form::open('rms/teams/edit/' . $team->id)}}

    <legend>Edit Team</legend>
        @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
        <label for="renew" class="checkbox">
            {{ Form::checkbox('renew', 1 , Input::old('renew',$team->is_active())) }} Renew for {{ Year::current_year()->year }}
        </label>
        @endif

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
        {{ HTML::link($cancel,'Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection
