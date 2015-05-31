@extends('templates.rms')

@section('title')
    @parent - Wellbeing Bundles 
@endsection

@section('content')
<h2>Bundles</h2>
@if ( count($bundles) > 0 )
    <table class="table table-bordered table-striped">
        <tr>
            <th>Name</th>
            <th>Year</th>
            <th>Price</th>
            <th>Tools</th>
        </tr>
    @foreach ($bundles as $bundle)
        <tr>
        <th>{{  $bundle->name }}</td>
        <td>{{  $bundle->year->year }} </td>
        <td>${{ $bundle->price }}</td>
        <td>
            <div class="btn-group">
                <a class="btn btn-primary" href="/rms/wellbeing/bundles/edit/{{$bundle->id}}">Edit</a>
                <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li>{{HTML::link('rms/wellbeing/bundles/manage/'. $bundle->id,'Manage')}}</li>
                    <li>{{HTML::link('rms/wellbeing/bundles/delete/'. $bundle->id,'Delete')}}</li>
                </ul>
            </div>
        </td>
        <tr>
    @endforeach
        </tbody>
    </table>
@else
    <p>No Bundles</p>
@endif

{{HTML::link('rms/wellbeing/bundles/add','Add New Bundle',array('class'=>'btn btn-primary'))}}

@endsection
