@layout('templates.rms')

@section('title')
    @parent - Edit Merch Order
@endsection

@section('content')
    {{ Form::open('rms/merch/orders/edit')}}

    <legend>Add Payment</legend>
        {{ Form::hidden('order_id',$order->id)}}

        Total: ${{ $order->total() }}

        {{ Form::label('amount_paid', 'Amount Paid') }}
        ${{ Form::text('amount_paid',Input::old('amount_paid', $order->amount_paid))}}<br>

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Quantity</th>
                </tr>
        @foreach ($order->items as $item)
                <tr>
                <th>{{ HTML::link('/rms/merch/items/show/'.$item->id,$item->title) }}</td>
                <td>${{ $item->price}}</td>
                <td>@if($item->has_size)
                        {{ Form::select('size['.$item->id.']', array('8'=>'8','10'=>'10','12'=>'12','14'=>'14','XS'=>'XS','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL'), $item->pivot->size)  }}
                    @else 
                        N/A
                        {{ Form::hidden('size['.$item->id.']', 'N/A') }}
                    @endif
                </td>
                <td>
                    {{ Form::text('quantity['.$item->id.']', $item->pivot->quantity) }}
                </td>
                <tr>
            @endforeach
                </tbody>
            </table>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/admin','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection