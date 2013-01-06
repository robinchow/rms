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
			<h4>{{$sponsor->name}}</h4>
				<p><a href="{{ $sponsor->url}}">
				<img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/>
			</a></p>
		@endforeach
	@endforeach
</div>
</div>
      
@endsection
