@extends('templates.rms')

@section('title')
    @parent - Edit Wellbeing Order
@endsection

@section('content')

    <legend>Order Wellbeing</legend>
        <p>Pay for wellbeing by giving cash to a producer on the night, or Direct Debit into the following account:</p>
        <p>
BSB: 062151<br />
Account Number: 1021 2168<br />
Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
Transaction Name: &lt;your name&gt; WELLBEING<br />
</p>
    <h3>Price: ${{$order->price()}}

    @if ($bundle == null)
        <h3>Bundle: Custom Selection</h3>
        <ul>
        @foreach ($order->nights()->get() as $night)
            <li>{{$night->date}}</li>
        @endforeach
        </ul>
    @else
        <h3>Bundle: {{$bundle->name}}</h3>
        <ul>
        @foreach ($bundle->nights()->get() as $night)
            <li>{{$night->date}}</li>
        @endforeach
        </ul>
    @endif

    <h3>Dietary Requirements</h3>
    <p> 
    @if ($order->dietary_requirements == "")
    None
    @else
    {{ $order->dietary_requirements }} 
    @endif
    </p>

    {{ HTML::link('/rms/wellbeing/orders/delete','Cancel Order',array('class'=>'btn btn-danger')) }}

@endsection
