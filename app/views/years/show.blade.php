@layout('templates.rms')

@section('title')
    @parent - show Year
@endsection

@section('content')


        <h2>{{ $year->year}}: {{ $year->name }} </h2>

        <h4>Mailing List: </h4>
        	{{ $year->mailing_list }}
        
        <h4>Members:</h4>
        <ul>
        @foreach($year->users as $user)
        	<li><a href="{{$user->profile_url()}}">{{$user->profile->full_name}}</a></li>
        @endforeach
    </ul>
      
@endsection