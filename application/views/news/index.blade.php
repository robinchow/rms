@layout('templates.rms')

@section('title')
    @parent - News
@endsection

@section('content')

@if ( count($news) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>News title</th>
			<th>Last updated</th>
			<th>Created on </th>
			<th>Tools</th>
		</tr>
	@foreach ($news as $n)
		<tr>
			<td>{{$n->title}}</td>
			<td>{{$n->updated_at}}</td>
			<td>{{$n->created_at}}</td>
			<td>
				{{ HTML::link('rms/news/edit/'. $n->id,'Edit')}}
				{{ HTML::link('rms/news/delete/'. $n->id,'Delete')}}
			</td>
		</tr>
	@endforeach
	</table>
@else
	No News
@endif


{{ HTML::link('rms/news/add/','Add')}}



@endsection
