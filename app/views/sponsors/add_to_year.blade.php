@extends('templates.rms')

@section('title')
    @parent - Add Sponsor to year
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/sponsors/add-to-year/'.$sponsor->id)) }}

    <legend>Add Sponsor to year</legend>

        {{ Form::label('year_id', 'Year') }}
        {{ Form::select('year_id', $years) }}<br>

        {{ Form::label('sponsor_level', 'Sponsorship Level') }}
        {{ Form::select('sponsor_level', array('Principal'=>'Principal','Major'=>'Major','Affiliate'=>'Affiliate'))  }}<br>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/sponsors','Cancel',array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection
