<x-user-layout title='Booking Success'>
    <div class="container py-5">
        <div class="row">
            <p class="message">Booking success!!</p>
        </div>
        <div class="ticket row">
            <div class="col-12">
                <a href="{{route('bookings.ticket', $booking->id)}}" class="btn btn-primary mb-3">Download Ticket</a>
                <p class="text-success">You can download the ticket from the Bookings History!</p>
            </div>
            <div class="ticket-header col-12">
                <h1>Booking Ticket</h1>
                <p>Thank you for booking with us!</p>
            </div>
            <div class="col-12 col-md-4">
                <div class="ticket-details">
                    <h2>Trip Details</h2>
                    <ul>
                        <li><strong>Trip Name:</strong> {{$booking->trip->destination}}</li>
                        <li><strong>Date:</strong> {{$booking->trip->start_at}} {{$booking->trip->end_at}}</li>
                        <li><strong>Duration:</strong> {{\Carbon\Carbon::parse($booking->trip->start_at)->diffInDays(\Carbon\Carbon::parse($booking->trip->end_at)) + 1 }} days</li>
                        <li><strong>Price:</strong> {{$booking->trip->price}} MAD</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="ticket-details">
                    <h2>Booking Details</h2>
                    <ul>
                        <li><strong>adults_number:</strong> {{$booking->adults_number}}</li>
                        <li><strong>children_number:</strong> {{$booking->children_number}}</li>
                        <li><strong>emergency_contact:</strong> {{$booking->emergency_contact}}</li>
                        <li><strong>total_amount:</strong> {{$booking->total_amount}} MAD</li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="ticket-details">
                    <h2>Passenger Details</h2>
                    <ul>
                        <li><strong>Name:</strong> {{$booking->user->name}}</li>
                        <li><strong>Email:</strong> {{$booking->user->email}}</li>
                        <li><strong>Phone:</strong> {{$booking->user->phone_number}}</li>
                        <li><strong>Address:</strong> {{$booking->user->address}}</li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="qr-code">
                    <h2>QR Code</h2>
                    <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
                </div>
            </div>
        </div>
    </div>

    <style>
        .ticket {
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket-details {
            margin-bottom: 20px;
        }
        .ticket-details ul {
            list-style-type: none;
            padding: 0;
        }
        .ticket-details ul li {
            margin-bottom: 10px;
        }
        .qr-code {
            text-align: center;
        }
    </style>
</x-user-layout>

