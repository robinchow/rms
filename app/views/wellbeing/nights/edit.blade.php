@extends('templates.rms')

@section('title')
    @parent -  Edit Night
@endsection

@section('content')

    {{HTML::style('css/datepicker.css')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}
    <script type="text/javascript">
            $(function() {
                $('#date').datepicker();
        });
    </script>

    {{ Form::open(array('url'=>'rms/wellbeing/nights/edit/'.$night->id)) }}

    <legend>Edit Night</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years, Input::old('year_id', $night->year->id)) }}<br>

		{{ Form::label('date', 'Date') }}
        <div class="input-append date" id="date" data-date="{{Input::old('date', $night->date)}}" data-date-format="dd-mm-yyyy">
            <input name="date" class="span2" size="16" type="text" value="{{Input::old('date', $night->date)}}" readonly="">
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>


        {{ Form::label('price', 'Price') }}
        $ {{ Form::text('price',Input::old('price', $night->price))}}<br>

        {{ Form::label('description', 'Description') }}
        $ {{ Form::text('description',Input::old('description', $night->description))}}<br>


        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/nights','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
