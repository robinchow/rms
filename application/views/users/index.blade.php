@layout('templates.rms')

@section('title')
    @parent - Users
@endsection

@section('content')

@if ( count($users) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>Full Name</th>
			<th>Display Name</th>
			<th>Admin</th>
			<th>Tools</th>
		</tr>
	@foreach ($users as $user)
		<tr>
			<td>{{$user->profile->full_name}}</td>
			<td>{{$user->profile->display_name}}</td>
			<td>{{$user->admin}}</td>
			<td>{{ HTML::link('rms/users/make_admin/'. $user->id,'Make Admin')}} - 
				{{ HTML::link('rms/users/remove_admin/'. $user->id,'Remove Admin')}} - 
				{{ HTML::link('rms/users/show/'. $user->id,'Show')}}</td>
		</tr>
	@endforeach
	</table>
@else
	No Users
@endif




@endsection
