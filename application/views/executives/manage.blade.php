@layout('templates.rms')

@section('title')
    @parent - Manage Executive Position
@endsection

@section('content')

    <h2>{{ $executive->position }}</h2>

    <legend>Add New Member</legend>
    {{ Form::vertical_open('rms/executives/manage/' . $executive->id)}}

    	{{ Form::hidden('executive_id', $executive->id)}}
    	{{ Form::hidden('year_id', $year->id)}}

        {{ Form::label('user', 'User') }}
        {{ Typeahead::create($users, null,array('name'=>'user'))}}<br>

        <label for="non_executive" class="checkbox">
            {{ Form::checkbox('non_executive', 1 )}} Non Executive/Assitant
        </label>

        {{ Form::submit('Add Member', array('class'=>'btn btn-primary'))}}
        {{ HTML::link('/rms/executives','Cancel', array('class'=>'btn')) }}
    {{ Form::close() }}
      

	<h3>Current Members ({{$year->year}})</h3>
	<ul>
	@foreach($executive->get_all_members($year->id) as $user)
    			<li>{{$user->profile->full_name}}
                    @if($user->pivot->non_executive)
                        (Assistant)
                        @endif
                    - {{HTML::link('rms/executives/member_remove/' . $user->id . '/' . $executive->id .'/' . $year->id ,'Remove')}}
                </li>
    		@endforeach
	</ul>




@endsection
