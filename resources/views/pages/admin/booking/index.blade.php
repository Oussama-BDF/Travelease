<x-admin-layout title='Bookings'>
    <x-slot name="header">{{ucfirst($status)}} Bookings</x-slot>
    
    <div class="row">
        <div class="col-12 p-0 bg-white shadow my-2 rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ucfirst($status)}} Bookings</h6>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Booking Date</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Emergency Contact</th>
                                <th>Total Amount</th>
                                <th>Trip</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>User</th>
                                <th>Booking Date</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Emergency Contact</th>
                                <th>Total Amount</th>
                                <th>Trip</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($bookings as $key => $booking)
                                <tr>
                                    <td>
                                        <a href="{{route('admin.users.show', $booking->user->id)}}">
                                            <img src="{{ $booking->user->profile_image_thumbnail ? asset('storage/' . $booking->user->profile_image_thumbnail) : asset('img/default_thumbnail.png') }}"
                                                class="object-fit-cover rounded-circle" style="width: 50px; height: 50px;" />
                                        </a>
                                    </td>
                                    <td>{{date('D, d M Y', strtotime($booking->created_at))}}</td>
                                    <td>{{$booking->adults_number}}</td>
                                    <td>{{$booking->children_number}}</td>
                                    <td>{{$booking->emergency_contact}}</td>
                                    <td>{{$booking->total_amount}} MAD</td>
                                    <td>
                                        <a href="{{route('admin.trips.show', $booking->trip->id)}}">{{$booking->trip->destination}}</a>
                                    </td>
                                    <td>{{$booking->payment_status}}</td>
                                    <form id="bookingForm{{$key}}" action="{{route('admin.bookings.update', $booking->id)}}" method="POST">
                                        <td>
                                            <select class="form-control" name="status" required >
                                                @foreach (['pending', 'confirmed', 'canceled'] as $item)
                                                    <option @selected($item == $booking->status) value="{{($item == $booking->status)? '' : $item}}">{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @csrf
                                            @method('PATCH')
                                            <button type="button" onclick="if(validateForm('bookingForm{{$key}}')) { this.form.submit(); }" class="btn btn-primary">Edit</button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-delete-modal password="false" title="Sure to delete this review?" description='Select "Delete" below if you are sure that you want delete this review.' />
    
</x-admin-layout>