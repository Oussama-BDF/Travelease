<x-admin-layout title='Users List'>
    <x-slot name="header">Users List</x-slot>
    <!-- DataTales -->
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Profile Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Profile Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td >{{$user->name}}</td>
                                    <td >{{$user->email}}</td>
                                    <td >{{$user->phone_number}}</td>
                                    <td >{{$user->address}}</td>
                                    <td class="text-center">
                                        <img src="{{ $user->profile_image_thumbnail ? asset('storage/' . $user->profile_image_thumbnail) : asset('img/default_thumbnail.png') }}"
                                            class="object-fit-cover rounded-circle" style="width: 50px; height: 50px;" />
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('admin.users.show', $user->uuid)}}" class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>