@props(['alert_type'])
<div class="alert alert-{{$alert_type}} position-fixed" role="alert" style="z-index: 10001; right: 10px; top: 10px;">
    {{$slot}}
</div>