@extends('templates.rms')

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
            <ul class="thumbnails">
            @foreach($executive->get_all_members($year->id) as $user)
                <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                    <img src="{{$user->image_url}}" alt="{{$user->profile->display_name}}" >
                    <center><caption>{{$user->profile->full_name}}
                    @if($user->pivot->non_executive)
                        (Assistant)
                    @endif
                    </caption></center>
                </a></li>

            @endforeach
            </ul>
        @endforeach


@endsection
