<x-admin-layout title='Transports List'>
    <x-slot name="header">Transports List</x-slot>
    <!-- Content Row -->
    <div class="row">
        @forelse($transports as $transport)
            <x-transport-card :transport='$transport'/>
        @empty
            <p>No Transport Available</p>
        @endforelse
    </div>
</x-admin-layout>