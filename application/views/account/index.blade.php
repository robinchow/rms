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


{{HTML::link('rms/account/edit','Edit Profile')}} - 
{{HTML::link('rms/account/logout','Logout')}}



@endsection
