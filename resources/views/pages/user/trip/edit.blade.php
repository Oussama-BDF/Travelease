<x-admin-layout title='Edit Trip'>
    <x-slot name="header">Edit Trip</x-slot>
    <!-- Content Row -->
    <div class="row">
        <x-trip-form :isUpdate="$isUpdate" :trip="$trip" :transports="$transports" />
    </div>
</x-admin-layout>
