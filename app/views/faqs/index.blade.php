@extends('templates.rms')

@section('title')
    @parent - FAQs
@endsection

@section('content')
<h2>FAQs</h2>
@if ( count($faqs) > 0 )
	<table class="table table-striped table-bordered">
		<tr>
			<th>Question + Answer</th>
			<th>Tools</th>
		</tr>
	@foreach ($faqs as $faq)
		<tr>
			<td><strong>{{$faq->question}}</strong><br>{{nl2br($faq->answer)}}</td>
			<td>
				<div class="btn-group">
					<a class="btn btn-primary" href="/rms/faqs/edit/{{$faq->id}}">Edit</a>
					<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>{{ HTML::link('rms/faqs/delete/'. $faq->id,'Delete')}}</li>
					</ul>
				</div>
			</td>
		</tr>
	@endforeach
	</table>
@else
	No FAQs
@endif


{{ HTML::link('rms/faqs/add/','Add',array('class'=>'btn btn-primary'))}}



@endsection
