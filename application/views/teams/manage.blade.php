@layout('templates.rms')

@section('title')
    @parent - Team Managed
@endsection

@section('content')
<section class="rms-teams">
<section>

    	<h2>{{ $team->name }}</h2>

    {{ Form::open('rms/teams/edit/' . $team->id)}}


        {{ Form::label('user', 'User') }}
        {{ Form::text('User')}}<br>


    {{ Form::close() }}
      
@endsection



</section>
</section>



@endsection
