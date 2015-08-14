@extends('templates.rms')

@section('title')
    @parent - Order Wellbeing
@endsection

@section('content')
    {{ Form::open(array('url'=>'rms/wellbeing/orders/new')) }}

    <legend>Order Wellbeing</legend>
        <p>Pay for wellbeing by giving cash to a producer on the night, or Direct Debit into the following account:</p>
        <p>
BSB: 062151<br />
Account Number: 1021 2168<br />
Account Name: CSE REVUE SOCIETY ACCOUNT 2<br />
Transaction Name: &lt;your name&gt; WELLBEING<br />
</p>
        
        <h3>Bundles</h3>
        <table class="table table-bordered table-striped">
            <tr>
                <th>Name</th>
                <th>Nights</th>
                <th>Price</th>
                <th>Select</th>
            </tr>

        @foreach ($bundles as $bundle)
            <tr>
                <td>{{$bundle->name}}</td>
                <td><ul>
                @foreach ($bundle->nights()->get() as $night)
                    <li>{{ $night->date }} ({{$night->description}})</li>
                @endforeach
                </ul></td>
                <td>$<span class='fixed-price-container' data-price = '{{$bundle->price}}'></span></td>
                <td>
                    {{ Form::radio('bundle', $bundle->id) }}
                </td>
            </tr>
        @endforeach
            <tr>
                <td>Custom Selection</td>
                <td>Select from table below</td>
                <td>$<span class='wellbeing-total'></span></td>
                <td>{{ Form::radio('bundle', 'custom', true) }}</td>
        </table>

        {{ Form::hidden('year_id', Year::current_year()->id)}}
        {{ Form::hidden('user_id', Auth::User()->id)}}

        <h3>Custom Selection</h3>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Price per Night</th>
                    <th>Yes/No</th>
                </tr>
            @foreach ($nights as $night)
                <tr>
                <td>{{ $night->date }}</td>
                <td>{{ $night->description }}</td>
                <td>$<span class='price'>{{ $night->price}}</span></td>
                <td>
                    <label for="yes" class="checkbox">
                        {{ Form::checkbox('yes['.$night->id.']', 1 , Input::old('yes['. $night->id. ']', 1), array('class' => 'wellbeing-checkbox')) }}
                    </label>
                </td>
                <tr>
            @endforeach
                </tbody>
            </table>
  
        <p><strong>Total: </strong>$<span class='wellbeing-total'>50</span></p>

        <h3>Dietary Requirements</h3>
        <p>(Leave blank if N/A)</p>
        <div>
        {{ Form::textarea('dietary_requirements', Input::old('dietary_requirements'))}}
        </div>

        {{ Form::submit('Order',array('class'=>'btn btn-primary')) }}
        {{ HTML::link('/rms/wellbeing/orders','Cancel',array('class'=>'btn')) }}

    {{ Form::close() }}
   
<script>
    $(function() {
        var total = 0;
        $('.wellbeing-checkbox').filter(':checked').each(function() {
            total += parseFloat($(this).parent().parent().parent().find('.price').text());
        });
        
        $('.wellbeing-total').text(total.toFixed(2));

        $('.fixed-price-container').each(function() {
            $(this).html(new Number($(this).attr('data-price')).toFixed(2));
        });
    });


    $('.wellbeing-checkbox').click(function(e) {
        var total = 0;
        $('.wellbeing-checkbox').filter(':checked').each(function() {
            total += parseFloat($(this).parent().parent().parent().find('.price').text());
        });
        
        $('.wellbeing-total').text(total.toFixed(2));
    });
</script>

@endsection
