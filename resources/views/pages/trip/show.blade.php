<x-master title='Trip'>
    <div class="container">
        <h1 class="my-4">Trip</h1>
        <a href="{{route('trips.index')}}" class="btn btn-secondary">Back</a>
        <div class="row my-4">
            <div class="card py-4">
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
                        <h4>Transport : </h4>{{ $trip->transport?->category ?? "Undefined" }} - {{ $trip->transport?->name}}
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
    </div>
</x-master>