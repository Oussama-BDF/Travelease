<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .ticket {
            width: 100%;
            padding: 10px
        }
        .ticket-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .ticket-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .ticket-header p {
            margin: 5px 0 0;
            font-size: 16px;
            color: #555;
        }
        .ticket-details {
            margin-bottom: 20px;
        }
        .ticket-details h2 {
            margin: 0 0 10px;
            font-size: 20px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .ticket-details ul {
            padding-inline: 10px;
            list-style-type: none;
            margin: 0;
        }
        .ticket-details ul li {
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px;
            font-size: 16px;
        }
        .ticket-details ul li strong {
            display: inline-block;
            width: 220px;
        }
        .qr-code {
            text-align: center;
        }
        .qr-code img {
            width: 200px;
            height: 200px;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="ticket-header">
            {{-- <img  width="100px" src="{{asset('img/img-grid-1.jpg')}}" alt="..." /> --}}
            <img width="100px" src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('img/logo-black.svg'))) }}" alt="..." />

            <h1>Booking Ticket</h1>
            <p>Thank you for booking with us!</p>
        </div>
        <div class="ticket-details">
            <h2>Trip Details</h2>
            <ul>
                <li><strong>Trip Name:</strong> {{$booking->trip->destination}}</li>
                <li><strong>Date:</strong> {{$booking->trip->start_at}} {{$booking->trip->end_at}}</li>
                <li><strong>Duration:</strong> {{\Carbon\Carbon::parse($booking->trip->start_at)->diffInDays(\Carbon\Carbon::parse($booking->trip->end_at)) + 1 }} days</li>
                <li><strong>Price:</strong> {{$booking->trip->price}} MAD</li>
            </ul>
        </div>
        <div class="ticket-details">
            <h2>Booking Details</h2>
            <ul>
                <li><strong>Adults Number:</strong> {{$booking->adults_number}}</li>
                <li><strong>Children Number:</strong> {{$booking->children_number}}</li>
                <li><strong>Emergency Contact: </strong> {{$booking->emergency_contact}}</li>
                <li><strong>Total Amount:</strong> {{$booking->total_amount}} MAD</li>
            </ul>
        </div>
        <div class="ticket-details">
            <h2>Passenger Details</h2>
            <ul>
                <li><strong>Name:</strong> {{$booking->user->name}}</li>
                <li><strong>Email:</strong> {{$booking->user->email}}</li>
                <li><strong>Phone:</strong> {{$booking->user->phone_number}}</li>
                <li><strong>Address:</strong> {{$booking->user->address}}</li>
            </ul>
        </div>
        <div class="qr-code">
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
        </div>
    </div>
    <div class="footer">
        Copyright &copy;
        All Rights Reserved &mdash; Explore Morocco {{now()->year}}
    </div>
</body>
</html>
