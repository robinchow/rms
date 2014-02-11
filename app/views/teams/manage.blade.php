@extends('templates.rms')

@section('title')
    @parent - Manage Team
@endsection

@section('content')
	<h2>{{ $team->name }}</h2>
    {{ Form::open(array('url' => 'rms/teams/manage/' . $team->id)) }}
	<legend>Add Member to Team</legend>

    	{{ Form::hidden('team_id', $team->id)}}
    	{{ Form::hidden('year_id', $year->id)}}

        {{ Form::label('user', 'User') }}
        <input name="user" autocomplete="off"
               type="text" data-provide="typeahead" 
               data-source='{{ json_encode($users) }}'>
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
				{{HTML::decode(HTML::link('rms/teams/member-remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member-move/' . $user->id . '/' . $team->id .'/' . $year->id . '/member' ,'<i class="icon-arrow-right"></i>', array('class'=>'btn btn-info')))}}
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
	@foreach($team->get_members($year->id,'member') as $user)
		<tr>
			<td>
				<a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a>
			</td>
			<td>
				<div class="btn-group">
				{{HTML::decode(HTML::link('rms/teams/member-remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/member' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member-move/' . $user->id . '/' . $team->id .'/' . $year->id . '/head' ,'<i class="icon-arrow-left"></i>', array('class'=>'btn btn-info')))}}
				{{HTML::decode(HTML::link('rms/teams/member-move/' . $user->id . '/' . $team->id .'/' . $year->id . '/interest' ,'<i class="icon-arrow-right	"></i>', array('class'=>'btn btn-info')))}}
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

	@foreach($team->get_members($year->id,'interest') as $user)
		<tr>
			<td>
				<a href="/rms/users/show/{{$user->id}}">{{$user->profile->full_name}}</a>
			</td>
			<td>
				<div class="btn-group">
				{{HTML::decode(HTML::link('rms/teams/member-remove/' . $user->id . '/' . $team->id .'/' . $year->id . '/interest' ,'<i class="icon-remove"></i>', array('class'=>'btn btn-danger')))}}
				{{HTML::decode(HTML::link('rms/teams/member-move/' . $user->id . '/' . $team->id .'/' . $year->id . '/member' ,'<i class="icon-arrow-left"></i>', array('class'=>'btn btn-info')))}}
				</div>
			</td>
		</tr>
	@endforeach
	</table>
</div>

</div>
@endif


@endsection
