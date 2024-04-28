@props(['alert_type'])
<div id="alert" class="alert alert-{{$alert_type}} alert-dismissible fade show position-fixed" role="alert" style="z-index: 2; right: 10px; top: 10px;">
    {{$slot}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
