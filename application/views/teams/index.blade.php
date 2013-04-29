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

<?php
    $user = Auth::user();

    // Collect teams by the type
    $head = array();
    $member = array();
    $interest = array();
    $other = array();

    $output = '';
    foreach($teams as $team) {
        // Get team status
        $status = $team->get_user_status($user->id);
        
        // Place into relevant list
        if ($status == 'head') {
            $head[] = $team;
        } elseif ($status == 'member') {
            $member[] = $team;
        } elseif ($status == 'interest') {
            $interest[] = $team;
        } else {
            $other[] = $team;
        }
    }
?>

<h4>Teams you are currently in</h4>
@if ( count($head) > 0 || count($member) > 0 || count($interest) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Team</th>
            <th>Mailing List</th>
            <th>Privacy</th>
            <th>Tools</th>
        </tr>

        <tbody>
            @foreach($head as $team)
                @include('teams.index.teamrow')->with('teamName', $team->name." (Head)")->with('interact', '')
            @endforeach
            @foreach($member as $team)
                @include('teams.index.teamrow')->with('teamName', $team->name)->with('interact', 'leave')
            @endforeach
            @foreach($interest as $team)
                @include('teams.index.teamrow')->with('teamName', $team->name." (Interested)")->with('interact', 'leave')
            @endforeach
        </tbody>
    </table>
@else
	<p>No Teams<p>
@endif

<h4>Other teams</h4>
@if( count($other) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Team</th>
            <th>Mailing List</th>
            <th>Privacy</th>
            <th>Tools</th>
        </tr>

        <tbody>
            @foreach($other as $team)
                @include('teams.index.teamrow')->with('teamName', $team->name)->with('interact', 'join')
            @endforeach
        </tbody>
    </table>
@else
	<p>No Teams<p>
@endif

@if(Auth::User()->admin )
{{HTML::link('rms/teams/add','Add Team',array('class'=>'btn btn-primary'))}}
@endif
{{HTML::link('rms/teams/index/archive','Archives',array('class'=>'btn btn-primary'))}}

@endsection
