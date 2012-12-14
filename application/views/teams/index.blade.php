@layout('templates.rms')

@section('title')
    @parent - Teams
@endsection

@section('content')
<section class="rms-teams">
<section>
@if ( count($teams) > 0 )
	@foreach ($teams as $team)
    	<p><strong>{{ $team->name }}</strong> - {{ HTML::link('/rms/teams/edit/'.$team->id,'Edit') }}  - {{ HTML::link('/rms/teams/delete/'.$team->id,'Delete')}}</p>
    	<p>{{ $team->alias }}</p>
    	<p>{{ $team->privacy }}</p>
    	<p>{{ nl2br($team->description) }}</p>
    	<p>Number of members Ever: {{ count($team->users)}}</p>
    	<hr>
	@endforeach
@else
	No Teams
@endif

{{HTML::link('rms/teams/add','Add Team',array('class'=>'button'))}}
{{HTML::link('rms/teams/join','Join A Team',array('class'=>'button'))}}

</section>
</section>



@endsection
