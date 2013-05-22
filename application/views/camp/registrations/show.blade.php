@layout('templates.rms')

@section('title')
    @parent - Show Registration For Camp
@endsection

@section('content')

    <legend>Show Registration for Camp</legend>
        <h4>Personal Details:</h4>
        {{ Form::hidden('id',$rego->id)}}
        Full Name: {{ $rego->user->profile->full_name }}<br>
        DOB: {{ $rego->user->profile->dob }}<br>
        Phone: {{ $rego->user->profile->number }}<br>
        Gender: {{ $rego->user->profile->gender }}<br>
        Arc: {{ $rego->user->profile->arc }}<br>
    <hr>
     <h4>Camp Related Details:</h4>
     <b>Medical</b>
     <p>{{$rego->medical}}</p>
     <b>Medical Conditions</b>
     <p>{{$rego->medical_conditions}}</p>

     <b>Dietary</b>
     <p>{{$rego->dietary}}</p>
     <b>Dietary Requirements</b>
     <p>{{$rego->dietary_requirements}}</p>


     <b>Car</b>
     <p>{{$rego->car}}</p>
     <b>Car Places</b>
     <p>{{$rego->car_places}}</p>

    <b>Song Requests</b>
    <p>{{ $rego->format_song_requests() }}</p>

    <b>Paid</b>
    <p>{{ $rego->paid}}</p>

      
@endsection
