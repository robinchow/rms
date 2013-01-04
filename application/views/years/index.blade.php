@layout('templates.rms')

@section('title')
    @parent - Years
@endsection

@section('content')

@if ( count($years) > 0 )
	@foreach ($years as $year)
    	<p><strong>{{ HTML::link('/rms/years/show/'.$year->id,$year->year.': '.$year->name ) }}</strong> - {{ HTML::link('/rms/years/edit/'.$year->id,'Edit') }}  - {{ HTML::link('/rms/years/delete/'.$year->id,'Delete') }}</p>
    	<p>{{ $year->alias }}</p>
    	<hr>
	@endforeach
@else
	No years
@endif


{{HTML::link('rms/years/add','Add year')}}


@endsection
