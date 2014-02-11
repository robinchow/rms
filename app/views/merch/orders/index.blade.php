@extends('templates.rms')

@section('title')
    @parent - My Merch Orders
@endsection

@section('content')
<h2>My Merch Orders</h2>
<p>
BSB: 062151<br />
Account Number: 1021 2168<br />
Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
Transaction Name: &lt;your name&gt; MERCH<br />
</p>
@if ( count($orders) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Date</th>
            <th>Cost</th>
            <th>Tools</th>
        </tr>
	@foreach ($orders as $order)
        <tr>
        <td>{{ HTML::link('/rms/merch/orders/show/'.$order->id,$order->created_at) }}</td>
        <td>${{ $order->total() }} (${{$order->amount_paid}} paid)</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/merch/orders/show/{{$order->id}}">View</a>

                @if (!$order->locked())
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#" style="padding-top:4px;padding-bottom:12px"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li>{{HTML::link('rms/merch/orders/user-edit/'. $order->id,'Edit Order')}}</li>
                <li>{{HTML::link('rms/merch/orders/delete/'. $order->id,'Delete Order')}}</li>
                </ul>
                @endif

            </div>
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	<p>No Orders</p>
@endif

{{HTML::link('rms/merch/orders/new','Order Merch',array('class'=>'btn btn-primary'))}}

@endsection
