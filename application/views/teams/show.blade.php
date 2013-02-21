@layout('templates.rms')

@section('title')
    @parent - Team
@endsection

@section('content')

    <h2>{{ $team->name }}</h2>
    	<strong>Mailing List:</strong>
    	<p>{{ $team->mailing_list }}</p>
    	<strong>Privacy:</strong>
    	<p>{{ $team->privacy_string }}</p>
    	<strong>Description:</strong>
    	<p>{{ nl2br($team->description) }}</p>
    	<strong>Members:</strong><br>
    	@foreach($team->years as $year)
    	    <hr>
    		<h3>{{$year->year}}:</h3>
    		<h4>Head</h3>
            <div class="row-fluid">
                <ul class="thumbnails">
            		@foreach($team->get_members($year->id,'head') as $key => $user)
            		<li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                        @if($year->id == Year::current_year()->id)
                        <img src="{{$user->image_url()}}" alt="{{$user->profile->display_name}}">
                        @endif
                        <center><caption>{{$user->profile->full_name}}</caption></center>
                    </a></li>
                    @if($key%6==0 && $key!=0)
                    </ul></div>
                    <div class="row-fluid">
                    <ul class="thumbnails">
                    @endif
            		@endforeach
                </ul>
            </div>

    		<h4>Members</h4>
            <div class="row-fluid">
                <ul class="thumbnails">
                    @foreach($team->get_members($year->id,'member') as $key => $user)
                    <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                        @if($year->id == Year::current_year()->id)
                        <img src="{{$user->image_url()}}" alt="{{$user->profile->display_name}}">
                        @endif
                        <center><caption>{{$user->profile->full_name}}</caption></center>
                    </a></li>
                    @if($key%6==0 && $key!=0)
                    </ul></div>
                    <div class="row-fluid">
                    <ul class="thumbnails">
                    @endif
                    @endforeach
                </ul>
            </div>

    		@if (!$team->privacy)
    		<h4>Interested</h4>
            <div class="row-fluid">
                <ul class="thumbnails">
                    @foreach($team->get_members($year->id,'interest') as $key => $user)
                    <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                        @if($year->id == Year::current_year()->id)
                        <img src="{{$user->image_url()}}" alt="{{$user->profile->display_name}}">
                        @endif
                        <center><caption>{{$user->profile->full_name}}</caption></center>
                    </a></li>
                    @if($key%6==0 && $key!=0)
                    </ul></div>
                    <div class="row-fluid">
                    <ul class="thumbnails">
                    @endif
                    @endforeach
                </ul>
            </div>
    		@endif
    	@endforeach
@endsection
