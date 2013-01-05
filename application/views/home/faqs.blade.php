@layout('templates.home')

@section('title')
    @parent - FAQ's
@endsection

@section('content')
	<div class="row">

    <div class="span10 offset1" id="main-title">
		<h2>FAQ&nbsp;</h2> 
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">
    <h3>Frequently Asked Questions</h3>

	<ul id="faq-list">
		@foreach($faqs as $faq)
		<li><strong>{{ $faq->question }}</strong></li>
		<p>{{ nl2br($faq->answer) }}</p>
		@endforeach    
	</ul>
</div>
</div>
      
@endsection
