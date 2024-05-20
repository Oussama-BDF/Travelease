@props(['trip'])
<div class="col-md-6 col-lg-4 mb-4">
    <div class="trip-card card rounded shadow">
        <img src="{{asset('storage/' . $trip->images->first()->path)}}"class="card-img-top object-fit-cover img-card" alt="" />
        <a href="{{ route('admin.trips.show', $trip->id) }}" class="stretched-link"></a>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5 class="mb-0"><span class="font-weight-bold">To : </span>{{ $trip->destination }}!</h5>
                <h5 class="mb-0 text-primary">{{ $trip->price }} MAD</h5>
            </div>

            <div class="text-center">
                <p class="small text-uppercase mb-1">{{ Str::limit($trip->description, 50) ?? "There Is No Description!"}}</p>
            </div>

            <div class="d-flex justify-content-center mb-2">
                <p class="text-muted mb-0">
                    <span class="font-weight-bold"></span>{{ \Carbon\Carbon::parse($trip->start_at)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($trip->end_at)->format('F j, Y') }} 
                    <span class="font-weight-bold"></span>({{ \Carbon\Carbon::parse($trip->start_at)->diffInDays(\Carbon\Carbon::parse($trip->end_at)) + 1 }} days)
                </p>
            </div>

            <div class="text-center">
                <p class="status {{$trip->status['class']}}">{{$trip->status['status']}}</p>
            </div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around" style="z-index: 1000;">
            <a class="btn btn-danger call-delete-modal" data-action="{{route('admin.trips.destroy', $trip->id)}}"  href="#" data-toggle="modal" data-target="#delete-modal-alert">Delete</a>
            <a href="{{route('admin.trips.edit', $trip->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>
</div>