@layout('templates.home')

@section('title')
    @parent - Sponsors
@endsection

@section('content')
	<div class="row">

    <div class="span10 offset1" id="main-title">
		<h2>Sponsors&nbsp;</h2> 
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">
	
	@foreach($years as $year)
		<h3>{{ $year->year }}</h3>
		@foreach($year->sponsors as $sponsor)
			{{ $sponsor->name}}
		@endforeach
	@endforeach
</div>
</div>
      
@endsection
