<x-user-layout title='Trip Detail'>
    <div class="container">
        <div class="card p-4 shadow mb-4">
            <p class="my-3 border-bottom border-gray font-weight-bold h5">Travel To : {{ $trip->destination}}</p>
            <div class="row">
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Price</p>
                    <ul><li>{{ $trip->price}} MAD</li></ul>
                </div>
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Accommodation</p>
                    <ul><li>{{ $trip->accommodation}}</li></ul>
                </div>
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Transport</p>
                    <ul><li>{{ $trip->transport?->name  ?? "Undefined" }}</li></ul>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Activities</p>
                    <ul>
                        @forelse($trip->activities as $activity)
                            <li>{{$activity->name}} : {{$activity->price}} MAD</li>
                        @empty
                            <li>No Activity Available</li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Dates</p>
                    <ul>
                        <li>Start At : {{ $trip->start_at}}</>
                        <li>End At : {{ $trip->start_at}}</li>
                    </ul>
                </div>       
                <div class="col-sm-4">
                    <p class="mb-2 font-weight-bold">Description</p>
                    <ul><li>{{ $trip->description  ?? "There Is No Description!"}}</li></ul>
                </div>
            </div>
            <div class="row">
                @foreach($trip->images as $image)
                <div class="col-md-4 mb-4 text-center">
                    <img src="{{ asset('storage/'.$image->path) }}" class="card-img-top img-card object-fit-cover rounded" alt="...">
                </div>
                @endforeach
            </div>
            <div class="card-footer text-muted d-flex justify-content-around" style="z-index: 1000;">
                <a href="#" class="btn btn-primary">Boook Now!</a>
            </div>
        </div>
    </div>
</x-user-layout>