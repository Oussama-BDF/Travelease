<x-user-layout title='Bookings History'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Adults</th>
                            <th scope="col">Children</th>
                            <th scope="col">Emergency Contact</th>
                            <th scope="col">Total Amount</th>
                            <th scope="col">Payment Status</th>
                            <th scope="col">Status</th>
                            <th scope="col">Trip</th>
                            <th scope="col">Date</th>
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
                                <td>
                                    {{$booking->payment_status}}
                                    @if($booking->payment_status == "unpaid")
                                        @php
                                            $unpaidError = "Note that the unpaid booking will be canceled after 5 days from the booking date"
                                        @endphp
                                        <form action="{{route('bookings.retryPayment', $booking->id)}}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </form>
                                    @endif
                                </td>
                                <td>{{$booking->status}}</td>
                                <td>
                                    <a href="{{route('trips.show', $booking->trip->id)}}">{{$booking->trip->destination}}</a>
                                </td>
                                <td>{{date('D, d M Y', strtotime($booking->created_at))}}</td>
                            </tr>
                        @empty
                            <p>No Booking Available, go and book a trip!</p>
                        @endforelse
                    </tbody>
                    <p class="text-danger">@isset($unpaidError) {{$unpaidError}} @endisset</p>
                </table>
            </div>
        </div>
    </div>
</x-user-layout>