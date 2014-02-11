@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')
<h2>Teams</h2>
<h4>Use the "Edit" dialogue to renew a team.</h3>
@if ( count($teams) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Team</th>
            <th>Mailing List</th>
            <th>Privacy</th>
            <th>Active</th>
            <th>Tools</th>
        </tr>
	@foreach ($teams as $team)
        <tr>
    	<th>{{ HTML::link('/rms/teams/show/'.$team->id,$team->name) }}</td>
    	<td>{{ $team->mailing_list }}</td>
    	<td>{{$team->privacy_string}}</td>
            <td>
            @if($team->is_active())
                <i class="icon-ok"></i>
            @else
                <i class="icon-remove"></i>
            @endif
            </td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/teams/edit/{{$team->id}}?renew=true">Edit</a>
                @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec() or Auth::User()->can_manage_team(Year::current_year()->id, $team->id))
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/teams/show/'. $team->id,'View Team')}}</li>
                    <li>{{HTML::link('rms/teams/manage/'. $team->id,'Manage Team')}}</li>
                    <li>{{HTML::link('rms/teams/delete/'. $team->id,'Delete Team')}}</li>

                </ul>
                @endif
            </div>
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	No Teams
@endif

{{HTML::link('rms/teams/add','Add Team',array('class'=>'btn btn-primary'))}}

@endsection
