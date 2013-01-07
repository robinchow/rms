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
    		<strong>{{$year->year}}</strong><br>
    		<strong>Head</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'head') as $user)
    			<li>{{$user->profile->full_name}}</li>
    		@endforeach
    		</ul>
    		<strong>Members</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'') as $user)
    			<li>{{$user->profile->full_name}}</li>
    		@endforeach
    		</ul>
    		@if (!$team->privacy)
    		<strong>Interested</strong>
    		<ul>
    		@foreach($team->get_members($year->id,'interested') as $user)
    			<li>{{$user->profile->full_name}}</li>
    		@endforeach
    		</ul>
    		@endif
    	@endforeach

{{HTML::link('rms/teams/manage/'. $team->id,'Manage Team',array('class'=>'button'))}}
{{HTML::link('rms/teams/edit/'. $team->id,'Edit Team',array('class'=>'button'))}}
{{HTML::link('rms/teams','Back',array('class'=>'button'))}}



@endsection
