<x-admin-layout title='User Details'>
    <x-slot name="header">User Details</x-slot>

    <div class="row my-4">
        <div class="col-sm-12 shadow p-0 rounded overflow-hidden">
            <div class="row user-card-full m-0">
                <div class="col-sm-4 user-profile py-4 px-0 bg-gradient-primary ">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <img class="rounded-circle object-fit-cover" style="width: 100px; height: 100px;" src="{{asset("storage/".($user->profile_image ?? 'profile/default.png'))}}" alt="User-Profile-Image">
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
                        {{-- <h6 class="my-3 border-bottom border-gray font-weight-bold">Recent Booking</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Trip Name</p>
                                <h6 class="text-muted">Oujeda</h6>
                                <h6 class="text-muted">El Jadida</h6>
                                <h6 class="text-muted">Chefchawen</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Date</p>
                                <h6 class="text-muted">08/05/2024</h6>
                                <h6 class="text-muted">08/05/2024</h6>
                                <h6 class="text-muted">08/05/2024</h6>
                            </div>
                            <a href="#" class="btn btn-primary btn-small">View All</a>
                        </div>
                        <h6 class="my-3 border-bottom border-gray font-weight-bold">Latest Reviews</h6>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-2 font-weight-bold">Trip Name</p>
                                <h6 class="text-muted">Marackech</h6>
                                <h6 class="text-muted">Rabat</h6>
                                <h6 class="text-muted">Casablanca</h6>
                            </div>
                            <div class="col-sm-4">
                                <p class="mb-2 font-weight-bold">Review</p>
                                <h6 class="text-muted">Dinoter husainm Dinoter...</h6>
                                <h6 class="text-muted">Dinoter husainm Dinoter...</h6>
                                <h6 class="text-muted">Dinoter husainm Dinoter...</h6>
                            </div>
                            <div class="col-sm-4">
                                <p class="mb-2 font-weight-bold">Rating</p>
                                <h6 class="text-muted"><x-user-rating rating="5" /></h6>
                                <h6 class="text-muted"><x-user-rating rating="3" /></h6>
                                <h6 class="text-muted"><x-user-rating rating="2" /></h6>
                            </div>
                            <a href="#" class="btn btn-primary btn-small">View All</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row my-4">
        <div class="col-12 p-0 bg-white shadow rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Review</th>
                                <th style="width: 125px">Rating</th>
                                <th style="width: 120px">Date</th>
                                <th>Action</th>
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
                                        <a class="btn btn-danger call-modal" data-action="{{route('admin.reviews.destroy', $review->id)}}"  href="#" data-toggle="modal" data-target="#delete-modal-alert">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-delete-modal title="Sure to delete this review?" description='Select "Delete" below if you are sure that you want delete this review.' />

</x-admin-layout>