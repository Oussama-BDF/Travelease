@props(['trip'])
<div class="col-md-6 col-lg-4 mb-4">
    <div class="trip-card card rounded shadow">
        <img src="{{asset('storage/' . $trip->images->first()->path)}}"class="card-img-top object-fit-cover img-card" alt="" />
        <a href="{{ route('trips.show', $trip->id) }}" class="stretched-link"></a>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0"><span class="font-weight-bold">To : </span>{{ $trip->destination }}!</h5>
                <h5 class="mb-0 text-primary">{{ $trip->price }} MAD</h5>
            </div>

            <div class="text-center">
                <p class="small text-uppercase mb-1">{{ Str::limit($trip->description, 50) ?? "There Is No Description!"}}</p>
            </div>

            <div class="d-flex justify-content-between mb-2">
                <p class="text-muted mb-0"><span class="font-weight-bold">Start At: </span>{{ $trip->start_at }}</p>
                <p class="text-muted mb-0"><span class="font-weight-bold">End At: </span>{{ $trip->end_at }}</p>
            </div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around" style="z-index: 1000;">
            <a href="{{route('bookings.create', $trip->id)}}" class="btn btn-outline-primary">Boook Now!</a>
        </div>
    </div>
</div>