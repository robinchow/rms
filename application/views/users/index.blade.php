@layout('templates.rms')

@section('title')
    @parent - Users
@endsection

@section('content')
<h2>Users</h2>
	<table class="table table-striped table-bordered">
		<tr>
			<th>Full Name</th>
			<th>Display Name</th>
			<th>Admin</th>
			<th>Tools</th>
		</tr>
	@foreach ($users->results as $user)
		<tr>
			<td>{{$user->profile->full_name}}</td>
			<td>{{$user->profile->display_name}}</td>
			<td>
				@if($user->admin)
					<i class="icon-ok"></i>
				@else
					<i class="icon-remove"></i>
				@endif
			</td>
			<td>
				<div class="btn-group">
					<a class="btn btn-primary" href="/rms/users/show/{{$user->id}}"><i class="icon-user icon-white"></i> Profile</a>
					@if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec())
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						@if($user->admin)
							<li><a href="/rms/users/remove_admin/{{$user->id}}"><i class="i"></i> Remove admin</a></li>
						@else
							<li><a href="/rms/users/make_admin/{{$user->id}}"><i class="i"></i> Make admin</a></li>
						@endif
					</ul>
					@endif
				</div>
			</td>
		</tr>
	@endforeach
	</table>
	{{$users->links(3, Paginator::ALIGN_CENTER, Paginator::SIZE_SMALL);}}





@endsection
