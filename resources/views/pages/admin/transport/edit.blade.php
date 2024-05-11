<x-admin-layout title='Edit Transport'>
    <x-slot name="header">Edit Transport</x-slot>
    <!-- Content Row -->
    <div class="row">
        <div class="col">
            <form action="{{route('admin.transports.update', $transport->id)}}" method="post" class="my-4">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="name">Name:</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" value='{{old("name", $transport->name)}}'>
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <input type="reset" class="btn btn-primary float-right" value="Reset">
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>