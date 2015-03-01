@extends('templates.home')

@section('title')
    @parent
@endsection

@section('content')
    <div class="row">
        <div class="span8 offset1">
            <div id="main-title">
            <h2>What is CSE Revue?&nbsp;</h2> 
            </div>
            <div id="main-content">
                <p>The Computer Science and Engineering (CSE) Revue is a live comedy sketch show held during September at the University of New South Wales (UNSW). Produced and directed by members of the society, the show serves to highlight the technical and creative talents of UNSW students, as well as an opportunity for students to further develop their university experience.</p>
                <center>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/rb8JKLDDXh0" frameborder="0" allowfullscreen></iframe>
                </center>
                <br>
                <p>Last year's CSE Revue was titled "Game of Codes", which delivered a raucous parody of the much beloved series "Game of Thrones", with the occasional CSE joke to spice it up.</p>
                <p>This show attracted well over 1000 audience members across four nights and left the audience in stitches. With high energy sketches and caricature portrayals of Ned Stark, King Joffrey and the Dragon Queen herself, all brought together on stage in a gamer-esque setting, laughter ensued.</p>
                <p>Filled with dancing, singing and comedic sketches, the show is presented by individuals of various backgrounds (and can I say, educational codes). CSE Revue promises a mix of acting, socialising and all 'round general fun; it is a great way to experience Uni life and meet others.</p>
                <p>Perhaps you'll be forced to dance until your legs fall off or deliver lines that'll shock audiences but you are guaranteed to have fun and make friends in this creative production experience.</p>
            </div>

            <div id="main-title">
                <h2>Latest News&nbsp;</h2> 
            </div>


            <div id="main-content">
                {{ implode(array_reverse(array_slice(array_map(function($item){return "
                <p><strong>$item[title]</strong><span style='float: right;'>".date('d M Y',strtotime($item['created_at']))."</span></p>
                <p>".nl2br($item['post'])."</p>
                ";}, News::all()->toArray()), -4, 4, true)), "<hr/>") }}
            </div>
        </div>

        <div class="span2">
            <div id="main-title">
                <h2>Sponsors&nbsp;</h2> 
            </div>

            <div id="sponsors">
                @foreach($sponsors as $sponsor)
                    <a href="{{ $sponsor->url}}">
                    <img src="/img/sponsor/{{ $sponsor->image }}"/>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
      
@endsection
