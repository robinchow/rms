@layout('templates.rms')

@section('title')
    @parent - FAQs
@endsection

@section('content')

@if ( count($faqs) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>Quesiton</th>
			<th>Answer</th>
			<th>Tools</th>
		</tr>
	@foreach ($faqs as $faq)
		<tr>
			<td>{{$faq->question}}</td>
			<td>{{$faq->answer}}</td>
			<td>
				{{ HTML::link('rms/faqs/edit/'. $faq->id,'Edit')}}
				{{ HTML::link('rms/faqs/delete/'. $faq->id,'Delete')}}
			</td>
		</tr>
	@endforeach
	</table>
@else
	No FAQs
@endif


{{ HTML::link('rms/faqs/add/','Add')}}



@endsection
