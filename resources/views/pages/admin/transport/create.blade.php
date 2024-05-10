<x-admin-layout title='Add Transport'>
    <x-slot name="header">Add Transport</x-slot>
    <!-- Content Row -->
    <div class="row">
        <x-transport-form :isUpdate="$isUpdate" :transport="$transport" />
    </div>
</x-admin-layout>