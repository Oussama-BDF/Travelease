<x-user-layout title='Trips List'>
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Trips List</h2>
            </div>
        </div>
        <div class="row">
            @forelse($trips as $trip)
                <x-user.trip-card :trip="$trip" />
            @empty
                <p class="message">Sorry No Trip Available!!</p>
            @endforelse
        </div>
        {{$trips->links()}}
    </div>
</x-user-layout>