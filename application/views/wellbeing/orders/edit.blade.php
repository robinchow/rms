@layout('templates.rms')

@section('title')
    @parent - Edit Wellbeing Order
@endsection

@section('content')
    {{ Form::open('rms/wellbeing/orders/edit/'.$order->id)}}

    <legend>Order Wellbeing</legend>
        <p>Pay for wellbeing by giving cash to a producer on the night, or Direct Debit into the following account:</p>
        <p>
BSB: 062151<br />
Account Number: 1021 2168<br />
Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
Transaction Name: &lt;your name&gt; WELLBEING<br />
</p>

        {{ Form::hidden('year_id', Year::current_year()->id)}}
        {{ Form::hidden('user_id', Auth::User()->id)}}

        {{ Form::label('dietary_requirements', 'Dietary Requirements:')}}
        {{ Form::textarea('dietary_requirements', Input::old('dietary_requirements', $order->dietary_requirements))}}

            <table class="table table-bordered table-striped">
                <tr>
                    <th>Date</th>
                    <th>Price per Night</th>
                    <th>Price per Night/for All Nights</th>
                    <th>Yes/No</th>
                </tr>
            @foreach ($nights as $night)
                <tr>
                <th>{{ $night->date }}</td>
                <td>${{ $night->price}}</td>
                <td>${{ $night->special_price}}</td>
                <td>
                    <label for="yes" class="checkbox">
                        {{ Form::checkbox('yes['.$night->id.']', 1 , Input::old('yes['. $night->id. ']', $mynights[$night->id])) }}
                    </label>
                </td>
                <tr>
            @endforeach
                </tbody>
            </table>
  
        <p></p>

        {{ Form::submit('Save Order',array('class'=>'btn btn-primary')) }}

    {{ Form::close() }}
      
@endsection
