@layout('templates.rms')

@section('title')
    @parent - All Wellbeing Orders
@endsection

@section('content')
<h2>All Wellbeing Orders - {{$year->year}}</h2>
@if ( count($nights) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Night</th>
            <th>Total Count</th>
            <th>Dietary Requirements</th>
        </tr>
	@foreach ($nights as $night)
        <tr>
            <th>{{ $night->date }}</td>
            <td>{{ $night->count() }}</td>
            <td>
                @foreach ($night->orders as $order)

                    @if($order->dietary_requirements != "")
                        <strong>{{$order->user->profile->full_name }}: </strong>{{ $order->dietary_requirements}}, <br>
                    @endif

                @endforeach
            </td>
        </tr>
	@endforeach
        </tbody>
    </table>
@else
	<p>No Nights</p>
@endif


@endsection
