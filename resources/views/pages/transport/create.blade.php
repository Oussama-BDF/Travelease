<x-master title='Add Transport'>
    <div class="container">
        <h1 class="my-4">Add Transport</h1>
        <a href="{{route('transports.index')}}" class="btn btn-secondary">Back</a>
        <form action="{{route('transports.store')}}" method="post" class="my-4">
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
</x-master>