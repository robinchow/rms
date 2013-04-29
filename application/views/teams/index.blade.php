@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')

{{-- Script for leave/join ajax call --}}
<script type="text/javascript">
    function member_leave(teamid) {
        //alert("Leave " + teamid);
        loading_ajax(teamid);
        do_ajax(teamid, "leave");
    }

    function member_join(teamid) {
        //alert("Join " + teamid);
        loading_ajax(teamid);
        do_ajax(teamid, "join");
    }

    function loading_ajax(teamid) {
        $("#" + teamid + ".btn-group").empty().toggle(false);
        
        var $ajaxcont = $("#" + teamid + ".ajax-content");
        $ajaxcont.append(
            '<div class="progress progress-striped active">' + 
                '<div class="bar" style="width: 100%;"></div>' + 
            '</div>'
            );
    }

    function finish_ajax(teamid, data) {
        var $ajaxcont = $("#" + teamid + ".ajax-content");
        $ajaxcont.empty();
        $ajaxcont.append(data);

        //var $btn = $("#" + teamid + ".btn-group");
        $ajaxcont.append(
            '<a class="btn" href="/rms/teams">Refresh</a>'
        );
        //$btn.toggle(true);
    }

    function do_ajax(teamid, type) {
        $.ajax({
            url:"/rms/teams/member_" + type + "_ajax/" + teamid
        }).done(
            function (data) {
                finish_ajax(teamid, data);
            }
        ).fail(
            function () {
                var $data = $('<span class="label label-important">Server Error</span>');
                finish_ajax(teamid, $data);
            }
        );
    }
</script>

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
        <?php
            // Load data
            $user = Auth::user();
            $teamNameStr = $team->name;

            // Set string for Head
            $teamheads = $team->get_heads_current;
            $isHead = false;
            foreach($teamheads as $head) {
                  $isHead = $isHead || $head->id == $user->id;
            }
            if($isHead) {
                $teamNameStr .= " (Head)";
            }
        ?>
        <tr>
    	<th>{{ HTML::link('/rms/teams/show/' . $team->id, $teamNameStr) }}</td>
    	<td>{{ $team->mailing_list }}</td>

    	<td>{{$team->privacy_string}}</td>
        <td>
            {{-- @ include('teams.index.joinleave') --}}
            <div class="ajax-content" id="{{$team->id}}">
            </div>

            <div class="btn-group" id="{{$team->id}}">
                @if(!$isHead)
                    @if(Auth::user()->is_part_of_team(Year::current_year()->id,$team->id) && !$team->privacy && $team->is_active())
                        <!--a class="btn" href="/rms/teams/member_leave/{{$team->id}}">Leave</a-->
                        <a class="btn" onclick="member_leave({{$team->id}})">Leave</a>
                    @elseif(!$team->privacy && $team->is_active())
                        <!--a class="btn" href="/rms/teams/member_join/{{$team->id}}">&nbsp;Join&nbsp;&nbsp;</a-->
                        <a class="btn" onclick="member_join({{$team->id}})">Join</a>
                    @endif
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
