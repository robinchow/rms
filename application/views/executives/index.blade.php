@layout('templates.rms')

@section('title')
    @parent - Executives
@endsection

@section('content')
<section class="rms-executives">
<section>
@if ( count($executives) > 0 )
    <table>
        <thead>
            <th>Position</th><th>Mailing Lists</th>        </thead>
        <tbody>
	@foreach ($executives as $executive)
        <tr>
    	<th>{{ HTML::link('/rms/executives/show/'.$executive->id,$executive->position) }}</td>
    	<td>{{ implode('<br>',$executive->mailing_lists) }}</td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	No Executives
@endif

{{HTML::link('rms/executives/add','Add Executive',array('class'=>'button'))}}
{{HTML::link('rms/executives/join','Join A executive',array('class'=>'button'))}}

</section>
</section>



@endsection
