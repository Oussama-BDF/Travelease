<x-admin-layout title='Edit Transport'>
    <x-slot name="header">Edit Transport</x-slot>
    <!-- Content Row -->
    <div class="row">
        <x-transport-form :isUpdate="$isUpdate" :transport="$transport" />
    </div>
</x-admin-layout>