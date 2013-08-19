@layout('templates.rms')

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
            <th>Tools</th>
        </tr>
	@foreach ($orders as $order)
        <tr>
    	<th>{{ HTML::link('/rms/merch/orders/show/'.$order->id,$order->created_at) }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/merch/orders/show/{{$order->id}}">View</a>
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/merch/orders/edit/'. $order->id,'Edit Order')}}</li>
                </ul>
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
