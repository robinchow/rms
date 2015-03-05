@extends('templates.rms')

@section('title')
    @parent - Sponsors
@endsection

@section('content')
<h2>Sponsors</h2>
This is a list of all the sponsors we have ever acquired.
@if ( count($sponsors) > 0 )
    <table class="table table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>Image</th>
            <th>Description</th>
            <th>Years</th>
            <th>Tools</th>
        </tr>
    @foreach ($sponsors as $sponsor)
        <tr>
            <td>{{ HTML::link($sponsor->url,$sponsor->name)}}</td>
            <td><img src="/img/sponsor/{{ $sponsor->image }}" width="100px" height="100px"/></td>
            <td>{{$sponsor->description}}
            <td>
                <ul>
                @foreach($sponsor->years as $year)
                    <li>{{$year->year}} - {{$year->pivot->sponsor_level}}</li>
                @endforeach
                </ul>

            </td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-primary" href="/rms/sponsors/edit/{{$sponsor->id}}">Edit</a>
                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>{{ HTML::link('rms/sponsors/add-to-year/'. $sponsor->id,'Add to year')}}</li>
                        <li>{{ HTML::link('rms/sponsors/remove-from-year/'. $sponsor->id,'Remove from year')}}</li>
                        <li>{{ HTML::link('rms/sponsors/delete/'. $sponsor->id,'Delete')}}</li>
                    </ul>
                </div>
            </td>

        </tr>
    @endforeach
    </table>
@else
    No Sponsors
@endif


{{ HTML::link('rms/sponsors/add/','Add', array('class'=>'btn btn-primary'))}}



@endsection
