@layout('templates.home')

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

	<h3>{{ $team->name }}</h3>
	
	<p>{{nl2br($team->description)}}</p>

</div>
</div>
      
@endsection