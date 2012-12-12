@layout('templates.rms')

@section('title')
    @parent - View Profile
@endsection

@section('content')
<h4>My Profile</h4>
{{ $user->profile->image }}
<h5>Email:</h5>
<p>{{ $user->email }}</p>
<h5>Full Name:</h5>
<p>{{ $user->profile->full_name }}</p>
<h5>Display Name:</h5>
<p>{{ $user->profile->display_name }}</p>

<h5>Phone:</h5>
<p>{{ $user->profile->phone }}</p>

<h5>Privacy:</h5>
<p>{{ $user->profile->privacy }}</p>

<h5>DOB:</h5>
<p>{{ $user->profile->dob }}</p>

<h5>University:</h5>
<p>{{ $user->profile->university }}</p>
<h5>Program:</h5>
<p>{{ $user->profile->program }}</p>
<h5>Student Number:</h5>
<p>{{ $user->profile->student_number }}</p>
<h5>Start Year:</h5>
<p>{{ $user->profile->start_year }}</p>

<h5>Arc:</h5>
<p>{{ $user->profile->arc }}</p>

<h5>Gender:</h5>
<p>{{ $user->profile->gender }}</p>


{{HTML::link('rms/account/edit','Edit Profile')}} - 
{{HTML::link('rms/account/logout','Logout')}}



@endsection
