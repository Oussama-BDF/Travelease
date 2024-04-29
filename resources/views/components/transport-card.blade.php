<div class="col-md-4 mb-4 text-center">
    <div class="card bg-dark text-white">
        <div class="card-body">
            <p class="card-text">Name : {{$transport->name}}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around">
            <form action="{{route('transports.destroy', $transport->id)}}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-danger">Delete</button>
            </form>
            <a href="{{route('transports.edit', $transport->id)}}" class="btn btn-success">Edit</a>
        </div>
    </div>
</div>