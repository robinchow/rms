@layout('templates.rms')

@section('title')
    @parent - My Account
@endsection



@section('content')
    {{ $user->email}}
      
@endsection