@extends('templates.rms')

@section('title')
    @parent - Add New Night
@endsection

@section('content')

    {{HTML::style('css/datepicker.css')}}
    {{HTML::script('js/bootstrap-datepicker.js')}}
    <script type="text/javascript">
            $(function() {
                $('#date').datepicker();
        });
    </script>

    {{ Form::open(array('url'=>'rms/wellbeing/nights/add')) }}

    <legend>Add New Night</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years, Input::old('year_id', Year::current_year()->id)) }}<br>

        {{ Form::label('date', 'Date') }}
        <div class="input-append date" id="date" data-date="{{Input::old('date')}}" data-date-format="dd-mm-yyyy">
            <input name="date" class="span2" size="16" type="text" value="{{Input::old('date')}}" readonly="">
            <span class="add-on"><i class="icon-calendar"></i></span>
        </div>


        {{ Form::label('price', 'Price') }}
        $ {{ Form::text('price',Input::old('price'))}}<br>

        {{ Form::label('description', 'Description') }}
        {{ Form::text('description',Input::old('description'))}}<br>


        {{ Form::submit('Save Changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/nights','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}

@endsection
