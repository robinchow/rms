@extends('templates.rms')

@section('title')
    @parent - All Orders
@endsection

@section('content')
<h2>All Orders - {{$year->year}}</h2>

@if ( count($orders) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th colspan="2">Order(Name - ID)</th>
            <th>Paid/Total</th>
        </tr></tr>
            <th>Item</th>
            <th>Size</th>
            <th>Quantity</th>
        </tr>
    @foreach ($orders as $order)
        <tr>
            <th colspan="2">{{ HTML::link('/rms/merch/orders/show/'.$order->id,$order->user->profile->full_name.' - '.$order->id) }}
                    {{ HTML::link('/rms/merch/orders/edit/'.$order->id,'Edit Order/Add Payment',array('class'=>'btn pull-right')) }}

            </td>
            <th>${{ $order->amount_paid }}/${{ $order->total() }}</th>
        </tr>
        @foreach($order->items as $oi) 
            <tr>
            <td>{{ $oi->title }}</td>
            <td>{{ $oi->pivot->size }}</td>
            <td>{{ $oi->pivot->quantity }}</td>
            <tr>
        @endforeach
    @endforeach
        </tbody>
    </table>

    @if ( count($items) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Item</th>
            <th>Size</th>
            <th>Quantity</th>
        </tr>
        @foreach ($items as $item)
            @if($item->has_size)
                @foreach($sizes as $size)
                <tr>
                <th>{{ $item->title }}</td>
                <td>{{ $size }}</td>
                <td>{{ $item->quantities($year->id, $size) }}</td>
                <tr>
                @endforeach
            @else 
            <tr>
            <th>{{ $item->title }}</td>
            <td>N/A</td>
            <td>{{ $item->quantities($year->id, 'N/A') }}</td>
            <tr>
            @endif
        @endforeach
        </tbody>
    </table>
    @endif

@else
    <p>No Orders</p>
@endif


@endsection
