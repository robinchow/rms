@layout('templates.rms')

@section('title')
    @parent - View Profile
@endsection

@section('content')
<legend>My Profile</legend>
<h5>Email:</h5>
<p>{{ $user->email }}</p>
{{ $user->profile->id}}



<div class="form-actions">
    {{HTML::link('rms/account/edit','Edit Profile')}}
</div>



@endsection
