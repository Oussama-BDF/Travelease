<x-admin-layout title='Reviews'>
    <x-slot name="header">Users Reviews</x-slot>
    
    <div class="row">
        <div class="col-12 p-0 bg-white shadow my-2 rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">DataTables</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Review</th>
                                <th style="width: 125px">Rating</th>
                                <th style="width: 120px">Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>User</th>
                                <th>Review</th>
                                <th>Rating</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($reviews as $key => $review)
                                <tr>
                                    <td class="text-center">
                                        <a href="{{route('admin.users.show', $review->user->id)}}">
                                            <img class="object-fit-cover rounded-circle" style="width: 50px; height: 50px;" src="{{asset("storage/".($review->user->profile_image_thumbnail ?? 'profile/thumbnails/default.png'))}}" alt="">
                                        </a>
                                    </td>
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