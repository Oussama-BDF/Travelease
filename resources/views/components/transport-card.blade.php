@props(['transport'])
<div class="col-xl-3 col-md-6 mb-4 text-center">
    <div class="card shadow h-100 py-2">
        <div class="card-body">
            <p class="h5 mb-0 text-gray-800">Name : {{$transport->name}}</p>
        </div>
        <div class="card-footer text-muted d-flex justify-content-around">
            <a class="btn btn-danger call-modal" data-action="{{route('admin.transports.destroy', $transport->id)}}"  href="#" data-toggle="modal" data-target="#delete-modal-alert">Delete</a>
            <a href="{{route('admin.transports.edit', $transport->id)}}" class="btn btn-secondary">Edit</a>
        </div>
    </div>
</div>