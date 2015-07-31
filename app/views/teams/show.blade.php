@extends('templates.rms')

@section('title')
    @parent - Team
@endsection

@section('content')

    <h2>{{ $team->name }}</h2>
    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec() || Auth::User()->can_manage_team($team->id))
        <div style="float: right">
            {{HTML::link('rms/teams/edit/'. $team->id,'Edit Team',array('class'=>'btn btn-primary'))}}
            {{HTML::link('rms/teams/manage/'. $team->id,'Manage Team',array('class'=>'btn btn-primary'))}}
        </div>
    @endif

    <strong>Heads Email:</strong>
    <p>{{ $team->heads_email }}</p>
    <strong>Mailing List:</strong>
    <p>{{ $team->mailing_list }}</p>
    @if(Auth::user()->admin || Auth::user()->is_currently_part_of_exec() || Auth::User()->can_manage_team($team->id))
        <strong>Interest List:</strong>
        <p>{{ $team->interest_email }}</p>
    @endif
    <strong>Privacy:</strong>
    <p>{{ $team->privacy_string }}</p>
    <strong>Description:</strong>
    <p>{{ nl2br($team->description) }}</p>
    <strong>Members:</strong><br>
    @foreach($team->years as $year)
        <hr>
        <h3>{{$year->year}}:</h3>
        <h4>Head</h3>
        @foreach($team->get_members($year->id,'head') as $key => $user)
            @if($key%6==0)
                @if($key!=0)
                </ul>
                </div>
            @endif
            <div class="row-fluid">
            <ul class="thumbnails">
            @endif
                <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                @if($year->id == Year::current_year()->id)
                    <img src="{{$user->image_url}}" alt="{{{$user->profile->display_name}}}">
                    @endif
                    <center><caption>{{{$user->profile->full_name}}}</caption></center>
                </a></li>


        @endforeach
        @if(count($team->get_members($year->id,'head'))>0)
            </ul>
            </div>
        @endif

        <h4>Members</h4>
        @foreach($team->get_members($year->id,'member') as $key => $user)
            @if($key%6==0)
                @if($key!=0)
                    </ul>
                    </div>
                @endif
                <div class="row-fluid">
                <ul class="thumbnails">
            @endif
            <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                @if($year->id == Year::current_year()->id)
                    <img src="{{$user->image_url}}" alt="{{{$user->profile->display_name}}}">
                @endif
                <center><caption>{{{$user->profile->full_name}}}</caption></center>
            </a></li>
        @endforeach
        @if(count($team->get_members($year->id,'member'))>0)
            </ul>
            </div>
        @endif

        @if (!$team->privacy)
            <h4>Interested</h4>
            @foreach($team->get_members($year->id,'interest') as $key => $user)
                @if($key%6==0)
                    @if($key!=0)
                        </ul>
                        </div>
                    @endif
                    <div class="row-fluid">
                    <ul class="thumbnails">
                @endif
                <li class="span2"><a href="/rms/users/show/{{$user->id}}" class="thumbnail">
                @if($year->id == Year::current_year()->id)
                    <img src="{{$user->image_url}}" alt="{{{$user->profile->display_name}}}">
                @endif
                <center><caption>{{{$user->profile->full_name}}}</caption></center>
                </a></li>
            @endforeach
            @if(count($team->get_members($year->id,'interest'))>0)
                </ul>
                </div>
            @endif
        @endif
    @endforeach
@endsection