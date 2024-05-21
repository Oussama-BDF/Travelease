<x-user-layout title='Booking Success'>
    <div class="container py-5">
        <div class="row">
            <p class="text-success">You can choose this QrCode in the Bookings History, you can download it any time!</p>
        </div>
        <div class="row">
            <p class="message">Booking success!!</p>
        </div>
        <style>
            .ticket {
                max-width: 600px;
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
        <a href="{{route('bookings.ticket')}}" class="btn btn-primary">Download Ticket</a>
        <div class="ticket">
            <div class="ticket-header">
                <h1>Booking Ticket</h1>
                <p>Thank you for booking with us!</p>
            </div>
            <div class="ticket-details">
                <h2>Trip Details</h2>
                <ul>
                    <li><strong>Trip Name:</strong> Trip to Paradise</li>
                    <li><strong>Date:</strong> June 15, 2024</li>
                    <li><strong>Departure Time:</strong> 10:00 AM</li>
                    <li><strong>Departure Location:</strong> Beachfront Hotel</li>
                    <li><strong>Duration:</strong> 3 days</li>
                </ul>
            </div>
            <div class="ticket-details">
                <h2>Passenger Details</h2>
                <ul>
                    <li><strong>Name:</strong> John Doe</li>
                    <li><strong>Email:</strong> johndoe@example.com</li>
                    <li><strong>Phone:</strong> +1234567890</li>
                </ul>
            </div>
            <div class="qr-code">
                <h2>QR Code</h2>        
                <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">

            </div>
        </div>
    </x-user-layout>

