@layout('templates.rms')

@section('title')
    @parent - Edit Year
@endsection

@section('content')
    {{ Form::open('rms/years/edit/' . $year->id)}}

    <legend>Edit Year</legend>

        {{ Form::label('year', 'Year') }}
        {{ Form::text('year', Input::old('year',$year->year), array('class'=>'input-xlarge'))}}<br>

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name',Input::old('name',$year->name),array('class'=>'input-xlarge'))}}<br>

        {{ Form::label('alias', 'Alias') }}
        {{ Form::text('alias',Input::old('alias',$year->alias),array('class'=>'input-xlarge'))}}<br>


            {{ Form::submit('Save changes', array('class'=>'btn btn-primary')) }}
            {{ HTML::link('/rms/years','Cancel', array('class'=>'btn')) }}


    {{ Form::close() }}
      
@endsection