@extends('templates.home')

@section('title')
    @parent - Teams
@endsection

@section('content')
	<div class="row">

    <div class="span10 offset1" id="main-title">
		<h2>Teams&nbsp;</h2> 
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">

	<p>Click a team name for more information:</p>
	<ul>
	@foreach($teams as $team)
		<li>{{HTML::link('/home/teams/'.$team->id,$team->name)}}</li>
	@endforeach
	</ul>
</div>
</div>
      
@endsection
