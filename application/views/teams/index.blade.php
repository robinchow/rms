@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')

@if ( count($teams) > 0 )
	@foreach ($teams as $team)
    	<p><strong>{{ $team->name }}</strong></p>
    	<p>{{ $team->alias }}</p>
    	<p>{{ $team->privacy }}</p>
    	<p>{{ nl2br($team->description) }}</p>
    	<hr>
	@endforeach
@else
	No Teams
@endif


{{HTML::link('rms/teams/add','Add Team')}}


@endsection
