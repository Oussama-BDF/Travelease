<x-user-layout title='Trips List'>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                @forelse($trips as $trip)
                    <x-user.trip-card :trip="$trip" />
                @empty
                    <p>No Trip Available</p>
                @endforelse
            </div>
        </div>
        {{$trips->links()}} 
    </section>
</x-user-layout>