<div class="col-md-4 mb-4 text-center">
    <div class="card bg-dark text-white">
        <div class="card-body">
            <h5 class="card-title">{{ $trip->destination }}</h5>
            <p class="card-text">{{ Str::limit($trip->description, 50) ?? "There Is No Description!"}}</p>
        </div>
        <span class="list-group-item">Start at: {{ $trip->start_at }} End At: {{ $trip->end_at }}</span>
        <span class="list-group-item">Transport Category: {{ $trip->transport?->category ?? "Undefined" }}</span>
        <span class="list-group-item">Transport Name: {{ $trip->transport?->name ?? "Undefined" }}</span>
        <span class="list-group-item" style="color: #8f0c0c"><b>Price: {{ $trip->price }}</b></span>
        <div class="card-footer text-muted d-flex justify-content-around">
            <a href="{{ route('trips.show', $trip->id) }}" class="btn btn-primary">View Details</a>
            <form action="{{route('trips.destroy', $trip->id)}}" method="post">
                @method('delete')
                @csrf
                <button class="btn btn-danger">Delete</button>
            </form>
            <a href="{{route('trips.edit', $trip->id)}}" class="btn btn-success">Edit</a>
        </div>
    </div>
</div>
