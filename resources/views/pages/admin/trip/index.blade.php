<x-admin-layout title='Trips List'>
    <x-slot name="header">Trips List</x-slot>
    <!-- Content Row -->
    <div class="row">
        @forelse($trips as $trip)
        <x-admin.trip-card :trip="$trip" />
        @empty
            <p>No Trip Available</p>
        @endforelse
    </div>
    {{$trips->links()}}
    <x-delete-modal password="false" title="Sure to delete this trip?" description='Select "Delete" below if you are sure that you want delete this trip.' />
</x-admin-layout>