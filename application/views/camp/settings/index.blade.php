@layout('templates.rms')

@section('title')
    @parent - Camp Settings
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
            <div class="btn-group">
                    @if(Auth::user()->is_part_of_team(Year::current_year()->id,$team->id) && !$team->privacy && $team->is_active())
                        <a class="btn" href="/rms/teams/member_leave/{{$team->id}}">Leave</a>
                    @elseif(!$team->privacy && $team->is_active())
                        <a class="btn" href="/rms/teams/member_join/{{$team->id}}">&nbsp;Join&nbsp;&nbsp;</a>
                    @endif

                <a class="btn btn-primary" href="/rms/teams/show/{{$team->id}}">View</a>
                @if(Auth::User()->admin or Auth::User()->can_manage_team(Year::current_year()->id, $team->id))
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/teams/manage/'. $team->id,'Manage Team')}}</li>
                    <li>{{HTML::link('rms/teams/edit/'. $team->id,'Edit Team')}}</li>
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

@if(Auth::User()->admin )
{{HTML::link('rms/teams/add','Add Team',array('class'=>'btn btn-primary'))}}
@endif
{{HTML::link('rms/teams/index/archive','Archives',array('class'=>'btn btn-primary'))}}

@endsection
