@extends('templates.rms')

@section('title')
    @parent - Manage Bundle
@endsection

@section('content')
    <h2>{{ $bundle->name }}</h2>
 
<div class="row-fluid">
<div class="span4">
    <h3>In Bundle</h3>
    <table class="table table-bordered table-striped">
                <tr><td>Night</td><td></td></tr>
    @foreach($bundle->nights()->get() as $night)
        <tr>
            <td>
            {{ $night->date }}
            </td>
            <td>
                <div class="btn-group">
                {{HTML::decode(HTML::link('rms/wellbeing/bundles/night-remove/' . $bundle->id . '/' . $night->id,'<i class="icon-arrow-right"></i>', array('class'=>'btn btn-info')))}}
                </div>
            </td>
        </tr>
    @endforeach
    </table>
</div>
<div class="span4">
    <h3>The Rest</h3>
    <table class="table table-bordered table-striped">
        <tr><td></td><td>Night</td></tr>
    @foreach($nights as $night)
        <tr>
            <td>
                <div class="btn-group">
                {{HTML::decode(HTML::link('rms/wellbeing/bundles/night-add/' . $bundle->id . '/' . $night->id,'<i class="icon-arrow-left"></i>', array('class'=>'btn btn-info')))}}
                </div>
            </td>
            <td>
            {{ $night->date }}
            </td>
        </tr>
    @endforeach
    </table>
</div>

</div>
{{ HTML::link('/rms/wellbeing/bundles','Back',array('class'=>'btn')) }}


@endsection
