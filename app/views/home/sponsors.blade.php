@extends('templates.home')

@section('title')
    @parent - Sponsors
@endsection

@section('content')
    <div class="row">

    <div class="span10 offset1" id="main-title">
        <h2>Sponsors&nbsp;</h2> 
    </div>
    </div>  

    <div class="row">
    <div class="span10 offset1" id="main-content">
        <h4>Here are the sponsors for CSE Revue {{$year->year}}:</h4>
        <table class="table table-no-border">            
        @foreach($sponsors as $sponsor)
            <tr>
                <td width="120px" style="text-align: center; vertical-align: middle;"><img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/></td>
                <td><h4><a href="{{ $sponsor->url}}">{{$sponsor->name}}</a></h4><p>{{$sponsor->description}}</p></td>
            </tr>
        @endforeach
        </table>
        <h4>Interested in a sponsorship CSE Revue? <a href="/home/sponsorship-opportunities">Learn how to become sponsor&nbsp;</a></h4>
    </div>
</div>
      
@endsection
