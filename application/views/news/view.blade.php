@layout('templates.rms')

@section('title')
    @parent - News - {{$news->title}}
@endsection

@section('content')
<h2>{{$news->title}}</h2>
<p>{{nl2br($news->post)}}</p>
<br>

@endsection
