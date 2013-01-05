@layout('templates.home')

@section('title')
    @parent - Executives
@endsection

@section('content')
	<div class="row">

    <div class="span10 offset1" id="main-title">
		<h2>Exec&nbsp;</h2> 
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">
    <h3>Executives</h3>
    <p>
	Email: exec@cserevue.org.au<br>
	The Executive for {{ $year->year }} are:
	</p>

	@foreach($execs as $exec)
		<h4>{{ $exec->position }}</h4>
		<ul>
		@foreach($exec->get_members($year->id) as $member)
			<li>{{$member->profile->full_name}}</li>
		@endforeach
		</ul>
		<p>Emails: {{ implode(', ', $exec->mailing_lists)}}</p>
	@endforeach
</div>
</div>
      
@endsection