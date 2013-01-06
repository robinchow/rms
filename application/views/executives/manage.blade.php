@layout('templates.rms')

@section('title')
    @parent - executive Managed
@endsection

@section('content')
<section class="rms-executive">
<section>

    	<h2>{{ $executive->name }}</h2>

    {{ Form::vertical_open('rms/executives/manage/' . $executive->id)}}

    	{{ Form::hidden('executive_id', $executive->id)}}
    	{{ Form::hidden('year_id', $year->id)}}


        {{ Form::label('user', 'User') }}
        {{ Typeahead::create($users, null,array('name'=>'user'))}}<br>

        {{ Form::label('non_executive', 'Non Executive Position') }}
        {{ Form::checkbox('non_executive', 1 )}}<br>

        {{ Form::submit('Add')}}
    {{ Form::close() }}
      

<div class="span9">
	<h3>Members</h3>
	<ul>
	@foreach($executive->get_all_members($year->id) as $user)
    			<li>{{$user->profile->full_name}}
                    @if($user->pivot->non_executive)
                        [NON-Executive]
                        @endif
                    - {{HTML::link('rms/executives/member_remove/' . $user->id . '/' . $executive->id .'/' . $year->id ,'Remove')}}
                </li>
    		@endforeach
	</ul>
</div>




</section>
</section>



@endsection
