@layout('templates.rms')

@section('title')
    @parent - Order Merch
@endsection

@section('content')
    {{ Form::open('rms/merch/orders/new')}}

    <legend>Order Merch</legend>
        <p>Pay for merch by giving cash to a producer, or Direct Debit into the following account:</p>
        <p>
BSB: 062151<br />
Account Number: 1021 2168<br />
Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
Transaction Name: &lt;your name&gt; MERCH<br />
</p>
        {{ Form::hidden('year_id', Year::current_year()->id)}}
        {{ Form::hidden('user_id', Auth::User()->id)}}

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Quantity</th>
                </tr>
            @foreach ($merch as $item)
                <tr>
                <th>{{ HTML::link('/rms/merch/items/show/'.$item->id,$item->title) }}</td>
                <td>${{ $item->price}}</td>
                <td>@if($item->has_size)
                        {{ Form::select('size['.$item->id.']', array('8'=>'8','10'=>'10','12'=>'12','14'=>'14','XS'=>'XS','S'=>'S','M'=>'M','L'=>'L','XL'=>'XL','XXL'=>'XXL'))  }}
                    @else 
                        N/A
                        {{ Form::hidden('size['.$item->id.']', 'N/A') }}
                    @endif
                </td>
                <td>
                    {{ Form::text('quantity['.$item->id.']') }}
                </td>
                <tr>
            @endforeach
                </tbody>
            </table>
  
        <p></p>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/orders','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection
