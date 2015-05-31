@extends('templates.rms')

@section('title')
    @parent - Renew Profile
@endsection

@section('content')
    {{ Form::open(array('url' => 'rms/account/renew'))}}

    <legend>Renew For Year</legend>
        Click the button below if you would like to renew for {{$year->year}}<br><br>
        {{ Form::submit('Renew', array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/account','Cancel', array('class'=>'btn')) }}



    {{ Form::close() }}
      
@endsection
