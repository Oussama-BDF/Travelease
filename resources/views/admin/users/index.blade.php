<x-admin-layout title='Users List'>
    <x-slot name="header">Users List</x-slot>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phon Number</th>
                            <th>Address</th>
                            <th>Profile Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phon Number</th>
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
                                <td class="text-center"><img src="{{asset("storage/".($user->profile_image_thumbnail ?? 'profile/thumbnails/default.png'))}}" alt=""></td>
                                <td class="text-center">
                                    <button class="btn btn-danger">Delete!</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>