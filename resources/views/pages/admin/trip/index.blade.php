<x-admin-layout title='Trips List'>
    <x-slot name="header">Trips List</x-slot>
    <!-- Content Row -->
    <div class="row">
        @forelse($trips as $trip)
        <x-trip-card :trip="$trip" />
        @empty
            <p>No Trip Available</p>
        @endforelse
    </div>
    {{$trips->links()}}
</x-admin-layout>