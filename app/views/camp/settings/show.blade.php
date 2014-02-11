@layout('templates.rms')

@section('title')
    @parent - Show Camp
@endsection

@section('content')

 <h2>{{ $camp->year->year }}: {{ $camp->theme }}</h2>
        <strong>Year:</strong>
        <p>{{ $camp->year->year }}</p>
        <strong>Theme:</strong>
        <p>{{ $camp->theme }}</p>
        <strong>Places:</strong>
        <p>{{ $camp->places }}</p>
        <strong>Places Remaining:</strong>
        <p>{{ $camp->remaining }}</p>
        <strong>Details:</strong>
        <p>{{ nl2br($camp->details) }}</p>
      
@endsection