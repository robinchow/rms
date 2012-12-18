@layout('templates.rms')

@section('title')
    @parent - Team Managed
@endsection

@section('content')
<section class="rms-teams">
<section>

    	<h2>{{ $team->name }}</h2>

    {{ Form::vertical_open('rms/teams/manage/' . $team->id)}}

    	{{ Form::hidden('team_id', $team->id)}}
    	{{ Form::hidden('year_id', $year->id)}}


        {{ Form::label('user', 'User') }}
        {{ Typeahead::create($users, null,array('name'=>'user'))}}

        {{ Form::label('status', 'Status') }}
        {{ Form::select('status',array('interested' => 'Interested', '' => 'Member', 'head'=>'Head'))}}<br>

        {{ Form::submit('Add')}}
    {{ Form::close() }}
      

<div class="span3">
	<h3>Heads</h3>
	<ul>
	@foreach($team->get_members($year->id,'head') as $user)
		<li>{{$user->profile->full_name}} 
			- {{HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'Remove')}}
			- {{HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'Member')}}
		</li>
	@endforeach
	</ul>
</div>
<div class="span3">
	<h3>Members</h3>
	<ul>
	@foreach($team->get_members($year->id,'') as $user)
		<li>{{$user->profile->full_name}} 
			- {{HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'Remove')}}
			- {{HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'Head')}}
			- {{HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '/interested' ,'Interested')}}

		</li>
	@endforeach
	</ul>
</div>
<div class="span3">
	<h3>Interested</h3>
	<ul>
	@foreach($team->get_members($year->id,'interested') as $user)
		<li>{{$user->profile->full_name}} 
			- {{HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/interested' ,'Remove')}}
			- {{HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'Member')}}

		</li>
	@endforeach
	</ul>
</div>




</section>
</section>



@endsection
