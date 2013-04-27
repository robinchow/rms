@layout('templates.rms')

@section('title')
    @parent - Blog Posts
@endsection

@section('content')
<h2>Blog Posts</h2>
@if ( count($blog_posts) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>Blog Post Title</th>
			<th>Last updated</th>
			<th>Created on </th>
			<th>Tools</th>
		</tr>
	@foreach ($blog_posts as $n)
		<tr>
			<td>{{$n->title}}</td>
			<td>{{$n->updated_at}}</td>
			<td>{{$n->created_at}}</td>
			<td>
				<div class="btn-group">
					<a class="btn btn-primary" href="/rms/blog/posts/show/{{$n->id}}">Show</a>
					<a class="btn btn-primary" href="/rms/blog/posts/edit/{{$n->id}}">Edit</a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('rms/blog/posts/delete/'. $n->id,'Delete')}}</li>
					</ul>
				</div>
			</td>
		</tr>
	@endforeach
	</table>
@else
	No Blog Posts
@endif


{{ HTML::link('rms/blog/posts/add','Add',array('class'=>'btn btn-primary'))}}



@endsection
