@props(['trip'])
<div class="col-xl-4 col-md-6 mb-4 text-center">
    <div class="card shadow h-100">
        <img src="{{asset('storage/' . $trip->images->first()->path)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="h5 mb-0 font-weight-bold text-gray-800">{{ $trip->destination }}</h5>
            <p class="text-xs font-weight-bold text-uppercase mb-1">{{ Str::limit($trip->description, 50) ?? "There Is No Description!"}}</p>
        </div>
        <span class="list-group-item"><b>Start at:</b> {{ $trip->start_at }} <b>End At:</b> {{ $trip->end_at }}</span>
        <span class="list-group-item"><b>Transport:</b> {{ $trip->transport?->name ?? "Undefined" }}</span>
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

