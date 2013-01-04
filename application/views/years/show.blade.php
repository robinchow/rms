@layout('templates.rms')

@section('title')
    @parent - show Year
@endsection

@section('content')


        <h2>{{ $year->year}}: {{ $year->name }} </h2>

        alias:{{ $year->alias}}<br>
        
        Members:
        <ul>
        @foreach($year->users as $user)
        	<li>{{$user->profile->full_name}}</li>


        @endforeach
    </ul>
      
@endsection