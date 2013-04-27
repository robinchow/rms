{{-- Place this here for Ajax --}}

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
