@layout('templates.rms')

@section('title')
    @parent - Years
@endsection

@section('content')
<h2>Years</h2>
@if ( count($years) > 0 )
	@foreach ($years as $year)
    	<p><strong>{{ HTML::link('/rms/years/show/'.$year->id,$year->year.': '.$year->name ) }}</strong>

    		{{ HTML::link('/rms/years/edit/'.$year->id,'Edit') }}
    		{{ HTML::link('/rms/years/delete/'.$year->id,'Delete') }}
    	</p>
    	<p>{{ $year->mailing_list }}</p>
    	<hr>
	@endforeach
@else
	No years
@endif


{{HTML::link('rms/years/add','Add year')}}


@endsection
