@extends('templates.rms')
@section('title')
    @parent - View Profile
@endsection

@section('extra_notice')
	@if($user->needs_to_renew)
	<div class="alert alert-warning">
		<h1>You Need to renew</h1>
		{{ Form::open('rms/account/renew')}}

		Click the button below if you would like to renew for {{Year::current_year()->year}}<br><br>
		{{ Form::submit('Renew', array('class'=>'btn btn-primary')) }}
		{{ Form::close() }}
	</div>
	@endif
@endsection


@section('content')
	{{ HTML::image($user->image_url, $user->profile->full_name, array('width'=>'200px','height'=>'200px','class'=>'pull-right')) }}

	<h2>{{$user->profile->full_name}}</h2>

    @if ($user->receive_emails)
        <p>You are subscribed to our general mailing list!</p>
        <a class="btn" href="/rms/account/unsubscribe">Unsubscribe</a>
    @else
        <p>You are <strong>not</strong> subscribed to our general mailing list!</p>
        <a class="btn btn-primary" href="/rms/account/subscribe">Subscribe</a>
    @endif

	<h3>Personal Details:</h3>

	<p><strong>Full Name: </strong>{{ $user->profile->full_name }}</p>
    @if($user->profile->display_name != "")
        <p><strong>Display Name: </strong>{{ $user->profile->display_name }}</p>
    @endif
	<p><strong>DOB: </strong>{{  $user->profile->dob }}</p>
	<p><strong>Gender: </strong>{{ $user->profile->gender }}</p>

	<h3>Contact Details:</h3>
	<p><strong>Email: </strong>{{ $user->email }}</p>
	<p><strong>Phone: </strong>{{ $user->profile->phone }}</p>

	<h3>University Details:</h3>
	<p><strong>University: </strong>{{ $user->profile->university }}</p>
	<p><strong>Program: </strong>{{ $user->profile->program }}</p>
	<p><strong>Student Number: </strong>{{ $user->profile->student_number }}</p>
	<p><strong>Start Year: </strong>{{ $user->profile->start_year }}</p>
	<p><strong>Arc: </strong>{{ $user->profile->arc_string }}</p>

	<h3>My Revue:</h3>
	@foreach($user->years as $year)
        <p><strong>{{$year->year}}: </strong>
            <?php
                // Generate the list for this year
                $teamlist = array();

                // Executives 
                foreach($user->executives()->where('year_id', '=', $year->id)->get() as $executive) {
                    $string = "<strong>".$executive->position;
                    if($executive->pivot->non_executive) {
                        $string .= " (Assistant)";
                    }
                    $string .= "</strong>";
                    $teamlist[] = $string;
                }
                // Head/Member/Interested
                $heads = array();
                $members = array();
                $interests = array();
                foreach($user->teams()->where('year_id', '=', $year->id)->get() as $team) {
                    $string = "";
                    if ($team->pivot->status == 'head') {
                        $heads[] = "<strong>".$team->name."</strong>";
                    } elseif ($team->pivot->status == 'member') {
                        $members[] = $team->name;
                    } else {
                        $interests[] = "<i>".$team->name."</i>";
                    }
                }
                $teamlist = array_merge($teamlist, $heads);
                $teamlist = array_merge($teamlist, $members);
                $teamlist = array_merge($teamlist, $interests);

                // Teamlist string
                $teamliststring = implode(", ", $teamlist);
                if (empty($teamlist)) {
                    $teamliststring = "<i>You were not part of any teams that year.</i>";
                }

            ?>
            {{$teamliststring}}
        </p>
	@endforeach

	<p>
        <b>Bold</b> = Team Head<br>
        Normal = Member<br>
        <i>Italics</i> = Interested 
	</p>

@endsection
