@layout('templates.rms')

@section('title')
    @parent - Sponsors
@endsection

@section('content')

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
				{{ HTML::link('rms/sponsors/edit/'. $sponsor->id,'Edit')}} - 
				{{ HTML::link('rms/sponsors/add_to_year/'. $sponsor->id,'Add to year')}} - 
				{{ HTML::link('rms/sponsors/remove_from_year/'. $sponsor->id,'Remove from year')}} - 
				{{ HTML::link('rms/sponsors/delete/'. $sponsor->id,'Delete')}}
			</td>

		</tr>
	@endforeach
	</table>
@else
	No sponsors
@endif


{{ HTML::link('rms/sponsors/add/','Add')}}



@endsection
