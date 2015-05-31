@extends('templates.rms')

@section('title')
    @parent - All Wellbeing Orders
@endsection

@section('content')
<h2>All Wellbeing Orders - {{$year->year}}</h2>
@if ( count($orders) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>User</th>
            <th>Bundle</th>
            <th>Dietary Requirements</th>
            <th>Owed</th>
        </tr>
    @foreach ($orders as $order)
    <tr>
        <td>{{$order->user->profile->full_name}}</td>
        <td>
        @if ($order->bundle() == null)
        Custom Selection ({{count($order->nights)}} nights)
        @else
        {{$order->bundle()->name}}
        @endif
        </td>
        <td>{{$order->dietary_requirements}}</td>
        <td>${{$order->price()}}</td>
    </tr>
    @endforeach
    </table>
@else
    <p>No Nights</p>
@endif


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
                @foreach ($night->all_orders() as $order)

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
