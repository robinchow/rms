@layout('templates.rms')

@section('title')
    @parent - Show Item
@endsection

@section('content')

 <h2>{{ $item->title }}</h2>
        <strong>Description:</strong>
        <p>{{ nl2br($item->description) }}</p>
        <strong>Price:</strong>
        <p>{{ $item->price }}</p>
        <strong>Has Sizes:</strong>
        <p>{{ $item->has_size }}</p>
        <strong>Active:</strong>
        <p>{{ $item->active }}</p>
      
@endsection