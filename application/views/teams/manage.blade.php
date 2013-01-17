@layout('templates.rms')

@section('title')
    @parent - Manage Team
@endsection

@section('content')
	<h2>{{ $team->name }}</h2>
    {{ Form::vertical_open('rms/teams/manage/' . $team->id)}}
	<legend>Add Member to Team</legend>

    	{{ Form::hidden('team_id', $team->id)}}
    	{{ Form::hidden('year_id', $year->id)}}

        {{ Form::label('user', 'User') }}
        {{ Typeahead::create($users, null,array('name'=>'user'))}}

        {{ Form::label('status', 'Status') }}
        {{ Form::select('status',$statuses) }}<br>

        {{ Form::submit('Add Member',array('class'=>'btn btn-primary'))}}
   
   {{ Form::close() }}
 
<legend>Current Members</legend>  
<div class="row-fluid">
<div class="span4">
	<h3>Heads</h3>
	<table class="table table-bordered table-striped">
				<tr><td>User</td><td>Tools</td></tr>
	@foreach($team->get_members($year->id,'head') as $user)
		<tr>
			<td>
				<a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a>
			</td>
			<td>
				<div class="btn-group">
				{{HTML::decode(HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'<i class="icon-arrow-right"></i>', array('class'=>'btn btn-info')))}}
				</div>
			</td>
		</tr>
	@endforeach
	</table>
</div>
<div class="span4">
	<h3>Members</h3>
	<table class="table table-bordered table-striped">
		<tr><td>User</td><td>Tools</td></tr>
	@foreach($team->get_members($year->id,'') as $user)
		<tr>
			<td>
				<a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a>
			</td>
			<td>
				<div class="btn-group">
				{{HTML::decode(HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'<i class="icon-arrow-left"></i>', array('class'=>'btn btn-info')))}}
				{{HTML::decode(HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '/interested' ,'<i class="icon-arrow-right	"></i>', array('class'=>'btn btn-info')))}}
				</div>
			</td>
		</tr>
	@endforeach
	</table>
</div>

@if(!$team->privacy)
<div class="span4">
	<h3>Interested</h3>
	<table class="table table-bordered table-striped">
			<tr><td>User</td><td>Tools</td></tr>

	@foreach($team->get_members($year->id,'interested') as $user)
		<tr>
			<td>
				<a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a>
			</td>
			<td>
				<div class="btn-group">
				{{HTML::decode(HTML::link('rms/teams/member_remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/interested' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member_move/' . $user->id . '/' . $team->id .'/' . $year->id . '' ,'<i class="icon-arrow-left"></i>', array('class'=>'btn btn-info')))}}
				</div>
			</td>
		</tr>
	@endforeach
	</table>
</div>

</div>
@endif


@endsection
