@layout('templates.rms')

@section('title')
    @parent - Executive
@endsection

@section('content')

    	<h2>{{ $executive->position }}</h2>
    	<strong>Mailing List:</strong>
    	<p>{{ $executive->mailing_list }}</p>
    	<strong>Members:</strong><br>
    	@foreach($years as $year)
    	    <hr>
    		<strong>{{$year->year}}</strong><br>
    		<ul>
    		@foreach($executive->get_all_members($year->id) as $user)
    			<li>{{$user->profile->full_name}}
                    @if($user->pivot->non_executive)
                        (Assistant)
                        @endif
                </li>
    		@endforeach
    		</ul>
    	@endforeach


@endsection
