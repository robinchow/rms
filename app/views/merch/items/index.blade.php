@extends('templates.rms')

@section('title')
    @parent - Merch Items
@endsection

@section('content')
<h2>Items</h2>
@if ( count($items) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Active</th>
            <th>Tools</th>
        </tr>
	@foreach ($items as $item)
        <tr>
    	<th>{{ HTML::link('/rms/merch/items/show/'.$item->id,$item->title) }}</td>
    	<td>{{ $item->description }}</td>
        <td>${{ $item->price }}</td>
        <td>{{ $item->active }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/merch/items/show/{{$item->id}}">View</a>
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/merch/items/edit/'. $item->id,'Edit item')}}</li>
                    @if ($item->active)
                        <li>{{HTML::link('rms/merch/items/deactivate/'. $item->id,'Deactivate item')}}</li>
                    @else
                        <li>{{HTML::link('rms/merch/items/activate/'. $item->id,'Activate item')}}</li>
                    @endif
                    <li>{{HTML::link('rms/merch/items/delete/'. $item->id,'Delete item')}}</li>
                </ul>
            </div>
        </td>
    	<tr>
	@endforeach
        </tbody>
    </table>
@else
	<p>No Items</p>
@endif

{{HTML::link('rms/merch/items/add','Add New Item',array('class'=>'btn btn-primary'))}}

@endsection
