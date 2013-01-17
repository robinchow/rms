@layout('templates.rms')

@section('title')
    @parent - Executives
@endsection

@section('content')
<h2>Executives</h2>
@if ( count($executives) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Position</th>
            <th>Mailing List</th>
            <th>Tools</th>
        </tr>
	@foreach ($executives as $executive)
        <tr>
    	   <td>{{ HTML::link('/rms/executives/show/'.$executive->id,$executive->position) }}</td>
    	   <td>{{ $executive->mailing_list }}</td>
           <td>
                <div class="btn-group">
                    <a class="btn btn-primary" href="/rms/executives/show/{{$executive->id}}">View</a>
                    @if(Auth::User()->admin)
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>{{HTML::link('rms/executives/manage/'. $executive->id,'Manage Executive',array('class'=>'button'))}}</li>
                        <li>{{HTML::link('rms/executives/edit/'. $executive->id,'Edit Executive Position',array('class'=>'button'))}}</li>
                        <li>{{HTML::link('rms/executives/delete/'. $executive->id,'Delete Executive Position',array('class'=>'button'))}}</li>

                    </ul>
                    @endif
                </div>
           </td>
    	</tr>
	@endforeach
    </table>
@else
	No Executives
@endif

@if(Auth::user()->admin)
    {{HTML::link('rms/executives/add','Add Executive Position',array('class'=>'btn btn-primary'))}}
@endif




@endsection
