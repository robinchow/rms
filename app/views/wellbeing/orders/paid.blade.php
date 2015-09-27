@extends('templates.rms')

@section('title')
    @parent - Mark Wellbeing as Paid
@endsection

@section('content')

    
    {{ Form::open(array('url'=>'rms/wellbeing/orders/paid/' . $order->id)) }}

        <legend>Mark as Paid</legend>
        <p>Total amount owed: {{$order->price()}}</p>

        <h3>Amount Paid</h3>
        <div>
        {{ Form::text('paid', $order->paid)}}
        </div>

        {{ Form::submit('Order',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/orders/admin','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}

@endsection
