<x-master title='Edit Transport'>
    <div class="container">
        <h1 class="my-4">Edit Transport</h1>
        <a href="{{route('transports.index')}}" class="btn btn-secondary">Back</a>
        <form action="{{route('transports.update', $transport->id)}}" method="post" class="my-4">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="category">Category:</label>
                <input class="form-control" type="text" id="category" name="category" placeholder="Enter category" value='{{old("category", $transport->category)}}'>
                @error('category')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
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
</x-master>