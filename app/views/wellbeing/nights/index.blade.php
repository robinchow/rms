@extends('templates.rms')

@section('title')
    @parent - Wellbeing Nights 
@endsection

@section('content')
<h2>Nights</h2>
@if ( count($nights) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Date</th>
            <th>Year</th>
            <th>Price</th>
            <th>Special Price</th>
            <th>Tools</th>
        </tr>
	@foreach ($nights as $night)
        <tr>
    	<th>{{  $night->date }}</td>
        <td>{{  $night->year->year}} </td>
        <td>${{ $night->price }}</td>
        <td>${{ $night->special_price }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/wellbeing/nights/edit/{{$night->id}}">Edit</a>
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/wellbeing/nights/delete/'. $night->id,'Delete')}}</li>
                </ul>
            </div>
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	<p>No Nights</p>
@endif

{{HTML::link('rms/wellbeing/nights/add','Add New Night',array('class'=>'btn btn-primary'))}}

@endsection
