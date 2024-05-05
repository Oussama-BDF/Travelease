<x-master title='Trips List'>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Trips List</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        @forelse($trips as $trip)
        <x-trip-card :trip="$trip" />
        @empty
            <p>No Trip Available</p>
        @endforelse
    </div>
    {{$trips->links()}}
</x-master>