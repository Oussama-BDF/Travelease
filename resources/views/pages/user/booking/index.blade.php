<x-user-layout title='Bookings History'>
    <div class="container py-5">
        <div class="row">
            @if($bookings->isEmpty())
                <p class="message">No Booking Available, go and book a trip!!</p>
            @else
                <div class="col-12 p-4 shadow bg-white my-2 rounded table-responsive">
                    <table class="table table-striped text-center">
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
                            @foreach ($bookings as $key => $booking)
                                <tr>
                                    <td scope="row">{{$key+1}}</td>
                                    <td>{{$booking->adults_number}}</td>
                                    <td>{{$booking->children_number}}</td>
                                    <td>{{$booking->emergency_contact}}</td>
                                    <td>{{$booking->total_amount}} MAD</td>
                                    <td>
                                        @if($booking->payment_status == "unpaid")
                                            @php
                                                $unpaidError = "Please note that unpaid bookings will be canceled if payment is not received."
                                            @endphp
                                            <form action="{{route('bookings.retryPayment', $booking->uuid)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">Go To Pay!</button>
                                            </form>
                                        @else
                                            <a href="{{route('bookings.ticket', $booking->uuid)}}" class="btn btn-outline-primary mb-3">Ticket <i class="fas fa-download fa-sm"></i></a>
                                        @endif
                                    </td>
                                    <td>{{$booking->status}}</td>
                                    <td>
                                        <a href="{{route('trips.show', $booking->trip->uuid)}}">{{$booking->trip->destination}}</a>
                                    </td>
                                    <td>{{date('D, d M Y', strtotime($booking->created_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <p class="text-danger">@isset($unpaidError) {{$unpaidError}} @endisset</p>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-user-layout>