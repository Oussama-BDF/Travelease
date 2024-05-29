<x-admin-layout title='Bookings'>
    <x-slot name="header">Bookings Validation</x-slot>
    
    <div class="row justify-content-center">
        <div class="col-auto">
            @if ($validated)
                <i class="far fa-check-circle text-primary" style="font-size: 200px;"></i>
            @else
                <i class="far fa-times-circle text-danger" style="font-size: 200px;"></i>
            @endif
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-auto">
            @if ($validated)
                <div class="h1 text-primary">Validated</div>
            @else
                <div class="h1 text-danger">Not Validated</div>
            @endif
        </div>
    </div> 
</x-admin-layout>