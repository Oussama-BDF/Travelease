@props(['trip'])
<div class="col-md-6 col-lg-4 mb-4">
    <div class="trip-card card rounded shadow">
        <img src="{{asset('storage/' . $trip->images->first()->path)}}"class="card-img-top object-fit-cover img-card" alt="" />
        <a href="{{ route('trips.show', $trip->uuid) }}" class="stretched-link"></a>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0">{{ $trip->destination }}</h5>
                <h5 class="mb-0 text-primary">{{ $trip->price }} MAD</h5>
            </div>

            <div class="text-center">
                <p class="small text-uppercase mb-1">{{ Str::limit($trip->description, 20) ?? "There Is No Description!"}}</p>
            </div>

            <div class="d-flex justify-content-center mb-2">
                <p class="text-muted mb-0 small">
                    {{ \Carbon\Carbon::parse($trip->start_at)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($trip->end_at)->format('F j, Y') }} 
                    ({{ \Carbon\Carbon::parse($trip->start_at)->diffInDays(\Carbon\Carbon::parse($trip->end_at)) + 1 }} days)
                </p>
            </div>

            <div class="text-center">
                <p class="status {{$trip->status['class']}}">{{$trip->status['status']}}</p>
            </div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around" style="z-index: 1000;">
            @if(!$trip->status['availability'])
                <a href="#" class="btn btn-secondary disabled"><del>Not Available</del></a>
            @else
                <a href="{{route('bookings.create', $trip->uuid)}}" class="btn btn-outline-primary">Boook Now!</a>
            @endif
        </div>
    </div>
</div>