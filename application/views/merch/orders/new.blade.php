@layout('templates.rms')

@section('title')
    @parent - Order Merch
@endsection

@section('content')
    {{ Form::open('rms/merch/orders/new')}}

    <legend>Order Merch</legend>
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
                <th>{{ $item->title}}</td>
                <td>{{ $item->price}}</td>
                <td>@if($item->has_size)
                    sizzes
                    @endif
                </td>
                <td></td>
                <tr>
            @endforeach
                </tbody>
            </table>
  
        <p></p>

        {{ Form::submit('Save changes',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/merch/items','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
      
@endsection