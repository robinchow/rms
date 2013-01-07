@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')

@if ( count($teams) > 0 )
    <table>
        <thead>
            <th>Team Name</th><th>Mailing Lists</th><th>Privacy</th>
        </thead>
        <tbody>
	@foreach ($teams as $team)
        <tr>
    	<th>{{ HTML::link('/rms/teams/show/'.$team->id,$team->name) }}</td>
    	<td>{{ $team->mailing_list }}</td>
    	<td>{{ $team->privacy_string }}</td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	No Teams
@endif

{{HTML::link('rms/teams/add','Add Team',array('class'=>'button'))}}
{{HTML::link('rms/teams/join','Join A Team',array('class'=>'button'))}}



@endsection
