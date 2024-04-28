<x-master title='Transport'>
    <div class="container">
        <h1 class="my-4">Transport List</h1>
        <a href="{{route('transports.create')}}" class="btn btn-primary">Add Transport</a>
        <div class="row my-4">
            @forelse($transports as $transport)
                <x-transport-card :transport='$transport'/>
            @empty
                <p>No Transport Available</p>
            @endforelse
        </div>
    </div>
</x-master>