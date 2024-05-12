<x-user-layout title='Edit Profile'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Adults Number</th>
                            <th scope="col">Children Number</th>
                            <th scope="col">Emergency Contact</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Status</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Booking Code</th>
                            <th scope="col">Trip</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bookings as $key => $booking)
                            <tr>
                                <td scope="row">{{$key+1}}</td>
                                <td>{{$booking->adults_number}}</td>
                                <td>{{$booking->children_number}}</td>
                                <td>{{$booking->emergency_contact}}</td>
                                <td>{{$booking->total_amount}} MAD</td>
                                <td>{{$booking->status}}</td>
                                <td>{{$booking->payment_status}}</td>
                                <td>{{$booking->booking_code}}</td>
                                <td>{{$booking->trip->destination}}</td>
                            </tr>
                        @empty
                            <p>No Booking Available, go and book a trip!</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-user-layout>