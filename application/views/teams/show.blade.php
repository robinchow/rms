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
    	@foreach($team->years as $year)
    	    <hr>
    		<h3>{{$year->year}}:</h3>
    		<h4>Head</h3>
            <ul class="thumbnails">
        		@foreach($team->get_members($year->id,'head') as $user)
        		<li><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                    <img src="/img/profile/{{$user->profile->image}}" alt="{{$user->profile->display_name}}" width='100px' height='100px' >
                    <center><caption>{{$user->profile->full_name}}</caption></center>
                </a></li>
        		@endforeach
            </ul>

    		<h4>Members</h4>
            <ul class="thumbnails">
    		    @foreach($team->get_members($year->id,'member') as $user)
                <li><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                    <img src="/img/profile/{{$user->profile->image}}" alt="{{$user->profile->display_name}}" width='100px' height='100px' >
                    <center><caption>{{$user->profile->full_name}}</caption></center>
                </a></li>
    		    @endforeach
    		</ul>

    		@if (!$team->privacy)
    		<h4>Interested</h4>
            <ul class="thumbnails">
                @foreach($team->get_members($year->id,'interest') as $user)
                <li><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                    <img src="/img/profile/{{$user->profile->image}}" alt="{{$user->profile->display_name}}" width='100px' height='100px' >
                    <center><caption>{{$user->profile->full_name}}</caption></center>
                </a></li>
                @endforeach
            </ul>
    		@endif
    	@endforeach
@endsection
