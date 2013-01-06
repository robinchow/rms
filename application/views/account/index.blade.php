@layout('templates.rms')

@section('title')
    @parent - View Profile
@endsection

@section('extra_notice')
	@if($user->needs_to_renew)
	<div class="alert alert-warning">
		<h1>You Need to renew</h1>
		<p>Click renew in the sidebar</p>
	</div>
	@endif
@endsection


@section('content')
		<h2>Your Profile</h2>
		<img src="/img/profile/{{ $user->profile->image }}" width="100px" height="100px"/>

		<hr>

		<h3>Personal Details:</h3>

		<p><strong>Full Name: </strong>{{ $user->profile->full_name }}</p>
		<p><strong>Display Name: </strong>{{ $user->profile->display_name }}</p>
		<p><strong>DOB: </strong>{{ $user->profile->dob }}</p>
		<p><strong>Gender: </strong>{{ $user->profile->gender }}</p>

		<hr>

		<h3>Contact Details:</h3>
		<p><strong>Email: </strong>{{ $user->email }}</p>
		<p><strong>Phone: </strong>{{ $user->profile->phone }}</p>
		<p><strong>Privacy: </strong>{{ $user->profile->privacy_string }}</p>

		<hr>

		<h3>University Details:</h3>
		<p><strong>University: </strong>{{ $user->profile->university }}</p>
		<p><strong>Program: </strong>{{ $user->profile->program }}</p>
		<p><strong>Student Number: </strong>{{ $user->profile->student_number }}</p>
		<p><strong>Start Year: </strong>{{ $user->profile->start_year }}</p>
		<p><strong>Arc: </strong>{{ $user->profile->arc_string }}</p>

@endsection
