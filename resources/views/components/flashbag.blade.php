@if(session()->has('success'))
    <x-alert alert_type="success">
        {!!session('success')!!}
    </x-alert>
@endif
@if(session()->has('failed'))
    <x-alert alert_type="danger">
        {!!session('failed')!!}
    </x-alert>
@endif
@if(session()->has('warning'))
    <x-alert alert_type="warning">
        {!!session('warning')!!}
    </x-alert>
@endif