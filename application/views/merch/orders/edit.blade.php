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

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/admin','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection