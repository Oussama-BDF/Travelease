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

    <x-delete-modal title="Sure to delete this trasnport?" description='Select "Delete" below if you are sure that you want delete this trasnport.' />
    
</x-admin-layout>