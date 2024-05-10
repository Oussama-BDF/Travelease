@props(['alert_type'])
<div class="alert alert-{{$alert_type}} alert-dismissible fade show position-fixed" role="alert" style="z-index: 2; right: 10px; top: 10px;">
    {{$slot}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>