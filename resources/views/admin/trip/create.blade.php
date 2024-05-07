<x-admin-layout title='Add Trip'>
    <x-slot name="header">Add Trip</x-slot>
    <!-- Content Row -->
    <div class="row">
        <x-trip-form :isUpdate="$isUpdate" :trip="$trip" :transports="$transports"/>
    </div>
</x-admin-layout>