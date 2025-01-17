<x-admin-layout title='User Details'>
    <x-slot name="header">User Details</x-slot>

    <div class="row my-4">
        <div class="col-sm-12 shadow p-0 rounded overflow-hidden">
            <div class="row user-card-full m-0">
                <div class="col-sm-4 user-profile py-4 px-0 bg-gradient-primary ">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <img src="{{ $user->profile_image ? asset('storage/' . $user->profile_image) : asset('img/default.png') }}"
                                class="object-fit-cover rounded-circle" style="width: 100px; height: 100px;" />
                        </div>
                        <p class="h4">{{$user->name}}</p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="p-4">
                        <h6 class="mb-3 border-bottom border-gray font-weight-bold">Information</h6>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Email</p>
                                <h6 class="text-muted">{{$user->email}}</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Phone</p>
                                <h6 class="text-muted">{{$user->phone_number}}</h6>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-12">
                                <p class="mb-2 font-weight-bold">Address</p>
                                <h6 class="text-muted">{{$user->address}}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 p-0 bg-white shadow my-2 rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">User Bookings</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Booking Date</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Emergency Contact</th>
                                <th>Total Amount</th>
                                <th>Trip</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Booking Date</th>
                                <th>Adults</th>
                                <th>Children</th>
                                <th>Emergency Contact</th>
                                <th>Total Amount</th>
                                <th>Trip</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user->bookings()->with('trip')->orderBy('id', 'desc')->get() as $key => $booking)
                                <tr>
                                    <td>{{date('D, d M Y', strtotime($booking->created_at))}}</td>
                                    <td>{{$booking->adults_number}}</td>
                                    <td>{{$booking->children_number}}</td>
                                    <td>{{$booking->emergency_contact}}</td>
                                    <td>{{$booking->total_amount}} MAD</td>
                                    <td>
                                        <a href="{{route('admin.trips.show', $booking->trip->uuid)}}">{{$booking->trip->destination}}</a>
                                    </td>
                                    <form id="bookingForm{{$key}}" action="{{route('admin.bookings.update', $booking->uuid)}}" method="POST">
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

    <div class="row my-4">
        <div class="col-12 p-0 bg-white shadow my-2 rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Review</th>
                                <th style="width: 160px">Rating</th>
                                <th style="width: 120px">Date</th>
                                <th style="width: 120px">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($user->reviews as $key => $review)
                                <tr>
                                    <td >{{$review->review}}</td>
                                    <td ><x-user-rating :rating="$review->rating" /></td>
                                    <td >{{date('D, d M Y', strtotime($review->created_at))}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-danger call-delete-modal" data-action="{{route('admin.reviews.destroy', $review->uuid)}}"  href="#" data-toggle="modal" data-target="#delete-modal-alert">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-delete-modal password="" title="Sure to delete this review?" description='Select "Delete" below if you are sure that you want delete this review.' />

</x-admin-layout>