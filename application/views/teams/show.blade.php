@layout('templates.rms')

@section('title')
    @parent - Team
@endsection

@section('content')

    <h2>{{ $team->name }}</h2>
    	<strong>Mailing List:</strong>
    	<p>{{ $team->mailing_list }}</p>
    	<strong>Privacy:</strong>
    	<p>{{ $team->privacy_string }}</p>
    	<strong>Description:</strong>
    	<p>{{ nl2br($team->description) }}</p>
    	<strong>Members:</strong><br>
    	@foreach($years as $year)
    	    <hr>
    		<strong>{{$year->year}}:</strong><br>
    		<strong>Head</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'head') as $user)
    			<li><a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a></li>
    		@endforeach
    		</ul>
    		<strong>Members</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'') as $user)
    			<li><a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a></li>
    		@endforeach
    		</ul>
    		@if (!$team->privacy)
    		<strong>Interested</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'interested') as $user)
    			<li><a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a></li>
    		@endforeach
    		</ul>
    		@endif
    	@endforeach
@endsection
