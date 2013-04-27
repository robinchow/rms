@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')

<h2>Teams</h2>
@if ( count($teams) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Team</th>
            <th>Mailing List</th>
            <th>Privacy</th>
            <th>Tools</th>
        </tr>
	@foreach ($teams as $team)
        <tr>
    	<th>{{ HTML::link('/rms/teams/show/'.$team->id,$team->name) }}</td>
    	<td>{{ $team->mailing_list }}</td>

    	<td>{{$team->privacy_string}}</td>
        <td>
            @include('teams.index.joinleave')
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	No Teams
@endif

@if(Auth::User()->admin )
{{HTML::link('rms/teams/add','Add Team',array('class'=>'btn btn-primary'))}}
@endif
{{HTML::link('rms/teams/index/archive','Archives',array('class'=>'btn btn-primary'))}}

@endsection
