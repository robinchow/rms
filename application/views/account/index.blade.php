@layout('templates.rms')

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
	{{ Image::polaroid('/img/profile/'.$user->profile->image, $user->profile->display_name,array('width'=>'200px','height'=>'200px','class'=>'pull-right')) }}

	<h2>Your Profile</h2>

	<h3>Personal Details:</h3>

	<p><strong>Full Name: </strong>{{ $user->profile->full_name }}</p>
	<p><strong>Display Name: </strong>{{ $user->profile->display_name }}</p>
	<p><strong>DOB: </strong>{{ $user->profile->dob }}</p>
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
	@forelse($user->teams()->where_year_id($year->id)->get() as $team)
		@if($team->pivot->status == 'head')
		<b>
		{{$team->name}},
		</b>
		@elseif($team->pivot->status == 'member')
		{{$team->name}},
		@else
		<i>
		{{$team->name}},
		</i>
		@endif
	@empty
	You were not part of any teams that year
	@endforelse

	</p>
	@endforeach
	<p>
	<b>Bold</b> = Team Head<br>
	Normal = Member<br>
	<i>Italics</i> = Interested 
	</p>

@endsection