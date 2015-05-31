@extends('templates.rms')

@section('title')
    @parent - Show Order
@endsection

@section('content')

 <h2>Order Created On: {{ $order->created_at }}</h2>
 <strong>Ordered By:</strong>
 <p>{{$order->user->profile->full_name}}</p>

@if ($order->user->id == Auth::user()->id)
    @if($order->remaining() == 0)
        <h3>Thank You For paying</h3>
    @else
        <h3>Please pay the remaining amount: ${{ $order->remaining() }}</h3>
        <p>In person to one of the producers or via direct deposit with the following description</p>
    <p>
    BSB: 062151<br />
    Account Number: 1021 2168<br />
    Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
    Transaction Name: &lt;your name&gt; MERCH<br />
    </p>
    @endif
@else
    @if($order->remaining() == 0)
        <h3>This order has been paid for</h3>
    @else
        <h3>Outstanding amount: ${{ $order->remaining() }}</h3>
    <p>
    BSB: 062151<br />
    Account Number: 1021 2168<br />
    Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
    Transaction Name: &lt;your name&gt; MERCH<br />
    </p>
    @endif
@endif
 <strong>Items:</strong>
 <table class="table table-bordered table-striped">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Size</th>
        <th>Quantity</th>
        <th>SubTotal</th>
    </tr>
@foreach ($order->items as $item)
    <tr>
    <th>{{ HTML::link('/rms/merch/items/show/'.$item->id,$item->title) }}</td>
    <td>${{ $item->price}}</td>
    <td>{{ $item->pivot->size }}</td>
    <td>{{ $item->pivot->quantity }}</td>
    <td>${{ $item->price * $item->pivot->quantity}}</td>
    </tr>
@endforeach
 <tr>
 <td colspan=3></td>
 <th>Total:</th>
 <td>${{ $order->total() }}</td>
 </tr>

 <tr>
 <td colspan=3></td>
 <th>Amount Paid:</th>
 <td>${{ $order->amount_paid }}</td>
 </tr>

    </tbody>
</table>
      
@endsection
