<x-admin-layout title='User Details'>
    <x-slot name="header">User Details</x-slot>

    <div class="row container m-auto">
        <div class="col-sm-12 shadow p-0 rounded overflow-hidden">
            <div class="row user-card-full m-0">
                <div class="col-sm-4 user-profile py-4 px-0 bg-gradient-primary ">
                    <div class="text-center text-white p-4">
                        <div class="mb-4">
                            <img class="rounded-circle object-fit-cover" style="width: 150px; height: 150px;" src="{{asset("storage/".($user->profile_image ?? 'profile/default.png'))}}" alt="User-Profile-Image">
                        </div>
                        <p class="h3">{{$user->name}}</p>
                        <p>{{$user->email}}</p>
                        <p>{{$user->phone_number}}</p>
                        <p>{{$user->address}}</p>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="p-4">
                        {{-- <h6 class="mb-3 border-bottom border-gray font-weight-bold">Information</h6>
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Email</p>
                                <h6 class="text-muted">{{$user->email}}</h6>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-2 font-weight-bold">Phone</p>
                                <h6 class="text-muted">{{$user->phone_number}}</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="mb-2 font-weight-bold">Address</p>
                                <h6 class="text-muted">{{$user->address}}</h6>
                            </div>
                        </div> --}}
                        <h6 class="my-3 border-bottom border-gray font-weight-bold">Recent Booking</h6>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>