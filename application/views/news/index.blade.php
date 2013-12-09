@layout('templates.rms')

@section('title')
    @parent - News
@endsection

@section('content')
<h2>News</h2>
@if ( count($news) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>News Title</th>
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
				<div class="btn-group">
					<a class="btn btn-primary" href="/rms/news/edit/{{$n->id}}">Edit</a>
					@if(Auth::User()->admin or Auth::User()->can_add_news())
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
					@endif
						<li>{{ HTML::link('rms/news/delete/'. $n->id,'Delete')}}</li>
					</ul>
				</div>
			</td>
		</tr>
	@endforeach
	</table>
@else
	No News
@endif

@if(Auth::User()->admin or Auth::User()->can_add_news())
{{ HTML::link('rms/news/add/','Add',array('class'=>'btn btn-primary'))}}
@endif


@endsection
