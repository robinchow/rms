@layout('templates.home')

@section('title')
    @parent - History
@endsection

@section('content')
	<div class="row">
	    <div class="span8 offset1" id="main-title">
			<h2>What is CSE Revue?&nbsp;</h2> 
		</div>

		<div class="span2" id="main-title">
			<h2>Sponsors&nbsp;</h2> 
		</div>
	</div>

	<div class="row">
		<div class="span8 offset1">
			<div id="main-content">
				<p>The Computer Science and Engineering (CSE) Revue is a live comedy sketch show held during September at the University of New South Wales (UNSW). Produced and directed by members of the society, the show serves to highlight the technical and creative talents of UNSW students, as well as an opportunity for students to further develop their university experience.</p>
				<p>Read more about us here.</p>
			<center>
				<object>
					<param name="movie" value="http://www.youtube.com/v/-xSsJNpeF1Y">
					<param name="wmode" value="transparent">
					<embed src="http://www.youtube.com/v/NK_co7s6Ct4" type="application/x-shockwave-flash" wmode="transparent" width="445" height="310">
				</object>
			</center>
			</div>
			
			<div id="main-title">
				<h2>Latest News&nbsp;</h2> 
			</div>


			<div id="main-content">
				news
			</div>
		</div>


		<div class="span2" id="main-content">
			@foreach($sponsors as $sponsor)
				<a href="{{ $sponsor->url}}">
				<img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/>
				</a>
			@endforeach
		</div>
	</div>
      
@endsection
