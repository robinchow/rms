@extends('templates.rms')

@section('title')
    @parent - Camp Registrations
@endsection

@section('content')
<h2>Camp Registrations</h2>
@if ( count($regos) > 0 )
    <table class="table table-bordered table-striped" id="camp_registrations">
        <thead>
            <tr>
                <th>Name</th>
                <th>Car</th>
                <th>Car Places</th>
                <th>Leaving From</th>
                <th>Arc</th>
                <th>Paid</th>
                <th>Has medical</th>
                <th>Has dietary</th>
                <th>Carpool</th>
                <th>Tools</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($regos as $rego)
                <tr>
                    <td>{{ HTML::link('/rms/camp/registrations/show/'.$rego->id,$rego->user->profile->full_name ) }}</td>
                    <td>
                        @if($rego->car)
                            Yes
                        @else
                            No          
                        @endif
                    </td>
                    <td>{{ $rego->car_places }}</td>
                    <td>{{ $rego->leave_from }}</td>
                    <td>
                        @if($rego->user->profile->arc)
                            Yes
                        @else
                            No          
                        @endif
                    </td>
                    <td>
                        @if($rego->paid)
                            Yes
                        @else
                            No          
                        @endif
                    </td>
                    <td>
                        @if($rego->medical)
                            Yes
                        @else
                            No          
                        @endif
                    </td>
                    <td>
                        @if($rego->dietary)
                            Yes
                        @else
                            No          
                        @endif
                    </td>
                    <td>
                        {{{ $rego->car_pool }}}
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-primary" href="/rms/camp/registrations/show/{{$rego->id}}">View</a>
                            <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @if($rego->paid)
                                <li>{{HTML::link('rms/camp/registrations/unpaid/'. $rego->id,'Mark As Not Paid')}}</li>
                                @else
                                <li>{{HTML::link('rms/camp/registrations/paid/'. $rego->id,'Mark As Paid')}}</li>
                                @endif
                                <li>{{HTML::link('rms/camp/registrations/delete/'. $rego->id,'Delete')}}</li>

                            </ul>
                        </div>
                    </td>
                <tr>
            @endforeach
        </tbody>
    </table>
    Total Arc:{{ $arc_count}}<br>
    Total : {{count($regos)}}<br>
    Total Arc Paid: {{$arc_paid_count}}<br>
    Total Paid: {{$paid_count}}<br>
@else
    <p>No camp registrations have been made</p>
@endif


<script>
    $("#camp_registrations").dataTable({
        paging: false,
        searching: false,
        bInfo: false
    });
</script>
@endsection
