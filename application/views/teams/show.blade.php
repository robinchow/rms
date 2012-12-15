@layout('templates.rms')

@section('title')
    @parent - Team
@endsection

@section('content')
<section class="rms-teams">
<section>

    	<h2>{{ $team->name }}</h2>
    	<strong>Mailing List:</strong>
    	<p>{{ $team->mailing_lists }}</p>
    	<strong>Privacy:</strong>
    	<p>{{ $team->privacy_string }}</p>
    	<strong>Description:</strong>
    	<p>{{ nl2br($team->description) }}</p>
    	<strong>Members:</strong><br>
    	@foreach($years as $year)
    		<strong>{{$year->year}}</strong>
    		<ul>
    		@foreach($team->get_members($year->id) as $user)
    			<li>{{$user->profile->full_name}}</li>
    		@endforeach
    		</ul>
    	@endforeach


{{HTML::link('rms/teams/edit/'. $team->id,'Edit Team',array('class'=>'button'))}}
{{HTML::link('rms/teams','Back',array('class'=>'button'))}}

</section>
</section>



@endsection
