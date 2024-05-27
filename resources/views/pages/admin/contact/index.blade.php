<x-admin-layout title='Bookings'>
    <x-slot name="header">Contacts</x-slot>
    
    <div class="row">
        <div class="col-12 p-0 bg-white shadow my-2 rounded card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Contacts</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($contacts as $key => $contact)
                                <tr>
                                    <td>{{$contact->fname}}</td>
                                    <td>{{$contact->lname}}</td>
                                    <td>{{$contact->email}}</td>
                                    <td>{{$contact->message}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</x-admin-layout>