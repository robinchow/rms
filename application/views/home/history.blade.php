@layout('templates.home')

@section('title')
    @parent - History
@endsection

@section('content')
	<div class="row">

    <div class="span10 offset1" id="main-title">
		<h2>History&nbsp;</h2> 
	</div>
	</div>

    <div class="row">

    <div class="span10 offset1" id="main-content">

    <p>The Computer Science and Engineering (CSE) Revue is a large-scale live comedy sketch show held over a series of nights in September on the Kensington Campus of the University of New South Wales (UNSW). Produced and directed by members of the CSE Revue Society, an Arc affiliated society of over 300 members consisting of students from a wide range of faculties, the show serves a dual purpose as a reputable production highlighting the technical and creative talents of UNSW students and an opportunity for students to develop and extend their university experience.</p>
	<p>The society was established in 2002 by Avishkar Misra, Naveed Hussain, Matthew Herrmann and other students with the support of the School of CSE and numerous industry sponsors. Student teams of cast, band, tech, design, costumes, scriptwriting, promotions and marketing were all involved in creating and staging the first CSE Revue. The show was a big success on campus, completely selling out all of its 5 shows.</p>
	<p>Since then, the CSE Revue has gone on to redefine the meaning of the Revue experience; leaving audiences in awe of our special effects, stylised achievements in design and our commitment to continually innovate.</p>

	@foreach($years as $year)
	<p>
		<strong>{{$year->year}}: {{$year->name}}</strong><br>
		Directors: {{$year->directors()}}<br>
		Producers: {{$year->producers()}}
	</p>
	@endforeach
</div>
</div>
      
@endsection
