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
			<th>Tools</th>
		</tr>
	@foreach ($sponsors as $sponsor)
		<tr>
			<td>{{$sponsor->name}}</td>
			<td>{{$sponsor->image}}</td>
			<td>
				{{ HTML::link('rms/sponsors/edit/'. $sponsor->id,'Edit')}}
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
