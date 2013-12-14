{{-- Single table row for team showing --}}

<tr>
    <th>{{ HTML::link('/rms/teams/show/' . $team->id, $teamName) }}</td>
    <td>{{ $team->mailing_list }}</td>
    <td>{{ $team->privacy_string }}</td>

    <td>
        <div class="ajax-content" id="{{$team->id}}">
        </div>

        <div class="btn-group" id="{{$team->id}}">
            @if(!$team->privacy && $team->is_active())
                @if($interact == 'leave')
                    <!--a class="btn" href="/rms/teams/member_leave/{{$team->id}}">Leave</a-->
                    <a class="btn" onclick="member_leave({{$team->id}})">Leave</a>
                @elseif($interact == 'join')
                    <!--a class="btn" href="/rms/teams/member_join/{{$team->id}}">&nbsp;Join&nbsp;&nbsp;</a-->
                    <a class="btn" onclick="member_join({{$team->id}})">Join</a>
                @endif
            @endif

            <a class="btn btn-primary" href="/rms/teams/show/{{$team->id}}">View</a>

            @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec() || Auth::User()->can_manage_team(Year::current_year()->id, $team->id))
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

