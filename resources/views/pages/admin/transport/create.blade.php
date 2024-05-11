<x-admin-layout title='Add Transport'>
    <x-slot name="header">Add Transport</x-slot>
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <form action="{{route('admin.transports.store')}}" method="post" class="my-4">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" value='{{old("name")}}'>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <input type="reset" class="btn btn-primary float-right" value="Reset">
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>