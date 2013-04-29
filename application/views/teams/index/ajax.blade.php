{{-- Place this here for Ajax --}}

@if($state == "success")
    <span class="label label-success">{{ $data }}</span>
@elseif($state == "warn")
    <span class="label label-warning">{{ $data }}</span>
@else
    <span class="label label-important">{{ $data }}</span>
@endif

