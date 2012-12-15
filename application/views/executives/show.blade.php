@layout('templates.rms')

@section('title')
    @parent - Executive
@endsection

@section('content')
<section class="rms-executives">
<section>

    	<h2>{{ $executive->position }}</h2>
    	<strong>Mailing List:</strong>
    	<p>{{ $executive->mailing_lists }}</p>
    	<strong>Members:</strong><br>
    	@foreach($years as $year)
    	    <hr>
    		<strong>{{$year->year}}</strong><br>
    		<ul>
    		@foreach($executive->get_members($year->id) as $user)
    			<li>{{$user->profile->full_name}}
                    @if($user->pivot->non_executive)
                        [NON-Executive]
                        @endif
                </li>
    		@endforeach
    		</ul>
    	@endforeach


{{HTML::link('rms/executives/edit/'. $executive->id,'Edit Executive',array('class'=>'button'))}}
{{HTML::link('rms/executives','Back',array('class'=>'button'))}}

</section>
</section>



@endsection
