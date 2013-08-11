@layout('templates.rms')

@section('title')
    @parent - Add New Item
@endsection

@section('content')
    {{ Form::open('rms/merch/items/add')}}

    <legend>Add New Item</legend>

        {{ Form::label('title', 'Title') }}
        {{ Form::text('title',Input::old('title'))}}<br>

		{{ Form::label('description', 'Description') }}
        {{ Form::textarea('description',Input::old('description'))}}<br>

        {{ Form::label('price', 'Price') }}
        {{ Form::text('price',Input::old('price'))}}<br>

        <label for="has_size" class="checkbox">
            {{ Form::checkbox('has_size', 1,Input::old('has_size') ) }} Has Sizes
        </label>

        <label for="active" class="checkbox">
            {{ Form::checkbox('active', 1,Input::old('active') ) }} Active
        </label>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/items','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection