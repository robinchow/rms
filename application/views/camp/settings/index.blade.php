@layout('templates.rms')

@section('title')
    @parent - Camp Settings
@endsection

@section('content')
<h2>Camps</h2>
@if ( count($camps) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Camp</th>
            <th>Places</th>
            <th>Places Remaining</th>
            <th>Visible</th>
            <th>Tools</th>
        </tr>
	@foreach ($camps as $camp)
        <tr>
    	<th>{{ HTML::link('/rms/camp/settings/show/'.$camp->id,$camp->year->year . ": " . $camp->theme) }}</td>
    	<td>{{ $camp->places }}</td>
        <td>{{ $camp->remaining }}</td>
        <td>{{ $camp->visible }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/camp/settings/show/{{$camp->id}}">View</a>
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/camp/settings/edit/'. $camp->id,'Edit Camp')}}</li>
                    <li>{{HTML::link('rms/camp/settings/delete/'. $camp->id,'Delete Camp')}}</li>

                </ul>
            </div>
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	<p>No Camps</p>
@endif

{{HTML::link('rms/camp/settings/add','Add New Camp',array('class'=>'btn btn-primary'))}}

@endsection
