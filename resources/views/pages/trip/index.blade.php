<x-master title='Trips List'>
    <div class="container">
        <h1 class="my-4">Trips List</h1>
        <a href="{{route('trips.create')}}" class="btn btn-primary">Add Trip</a>
        <div class="row my-4">
            @forelse($trips as $trip)
                <x-trip-card :trip="$trip" />
            @empty
                <p>No Trip Available</p>
            @endforelse
        </div>
        {{$trips->links()}}
    </div>
</x-master>