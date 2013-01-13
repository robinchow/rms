@layout('templates.rms')

@section('title')
    @parent - Years
@endsection

@section('content')
<h2>Years</h2>
@if ( count($years) > 0 )
	@foreach ($years as $year)
    	<strong>{{ HTML::link('/rms/years/show/'.$year->id,$year->year.': '.$year->name ) }}</strong>
            @if(Auth::User()->admin)
                <div class="btn-group pull-right">
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                            <li><a href="/rms/years/edit/{{$year->id}}"><i class="i"></i> Edit Year</a></li>
                            <li><a href="/rms/years/delete/{{$year->id}}"><i class="i"></i> Delete Year</a></li>
                    </ul>
                </div>
            @endif
    	
    	<p>{{ $year->mailing_list }}</p>
    	<hr>
	@endforeach
@else
	No years
@endif

 @if(Auth::User()->admin)
    {{HTML::link('rms/years/add','Add year', array('class'=>'btn btn-primary'))}}
@endif

@endsection
