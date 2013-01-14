@layout('templates.rms')

@section('title')
    @parent - Sponsors
@endsection

@section('content')
<h2>Sponsors</h2>
@if ( count($sponsors) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Years</th>
			<th>Tools</th>
		</tr>
	@foreach ($sponsors as $sponsor)
		<tr>
			<td>{{ HTML::link($sponsor->url,$sponsor->name)}}</td>
			<td><img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/></td>
			<td>
				<ul>
				@foreach($sponsor->years as $year)
					<li>{{$year->year}}</li>
				@endforeach
				</ul>

			</td>
			<td>
				<div class="btn-group">
					<a class="btn btn-primary" href="/rms/sponsors/edit/{{$sponsor->id}}">Edit</a>
					@if(Auth::User()->admin)
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('rms/sponsors/add_to_year/'. $sponsor->id,'Add to year')}}</li>
						<li>{{ HTML::link('rms/sponsors/remove_from_year/'. $sponsor->id,'Remove from year')}}</li>
						<li>{{ HTML::link('rms/sponsors/delete/'. $sponsor->id,'Delete')}}</li>
					</ul>
					@endif
				</div>
			</td>

		</tr>
	@endforeach
	</table>
@else
	No Sponsors
@endif


{{ HTML::link('rms/sponsors/add/','Add', array('class'=>'btn btn-primary'))}}



@endsection
