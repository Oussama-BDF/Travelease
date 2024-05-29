@props(['transport', 'key'])
<div class="col-xl-3 col-md-6 mb-4 text-center">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <p class="h5 mb-0 text-gray-800">Name : {{$transport->name}}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around">
            <a class="btn btn-danger call-delete-modal" data-action="{{route('admin.transports.destroy', $transport->uuid)}}"  href="#" data-toggle="modal" data-target="#delete-modal-alert">Delete</a>
            <a class="btn btn-secondary call-edit-modal" data-name="{{$transport->name}}" data-action="{{route('admin.transports.update', $transport->uuid)}}"  href="#" data-toggle="modal" data-target="#edit-modal-alert">Edit</a>
        </div>
    </div>
</div>