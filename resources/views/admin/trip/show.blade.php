<x-admin-layout title='Trip'>
    <x-slot name="header">Trip</x-slot>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card p-4 shadow mb-4">
                <div class="cardbody">
                    <div class="card-text">
                        <h4>Destination : </h4> {{ $trip->destination}}
                    </div>
                    <div class="card-text">
                        <h4>start_at : </h4> {{ $trip->start_at}}
                    </div>
                    <div class="card-text">
                        <h4>end_at : </h4> {{ $trip->end_at}}
                    </div>
                    <div class="card-text">
                        <h4>description : </h4> {{ $trip->description  ?? "There Is No Description!"}}
                    </div>
                    <div class="card-text">
                        <h4>price : </h4> {{ $trip->price}}
                    </div>
                    <div class="card-text">
                        <h4>accommodation : </h4> {{ $trip->accommodation}}
                    </div>
                    <div class="card-text">
                        <h4>Transport : </h4>{{ $trip->transport?->name  ?? "Undefined" }}
                    </div>
                    <div class="card-text">
                        <h4>Activities : </h4>
                        <ul>
                        @forelse($trip->activities as $activity)
                            <li>{{$activity->name}} : {{$activity->price}}</li>
                        @empty
                            <li>No Activity Available</li>
                        @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @foreach($trip->images as $image)
        <div class="col-md-4 mb-4 text-center">
            <div class="card bg-dark text-white">
                <img src="{{ asset('storage/'.$image->path) }}" class="card-img-top" alt="...">
            </div>
        </div>
        @endforeach
    </div>
</x-admin-layout>