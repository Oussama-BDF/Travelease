<x-admin-layout title='Transports List'>
    <x-slot name="header">Transports List</x-slot>
    {{-- Content Row --}}
    <div class="row">
        @forelse($transports as $key => $transport)
            <x-admin.transport-card :transport='$transport' :key='$key'/>
        @empty
            <p>No Transport Available</p>
        @endforelse
    </div>

    <x-delete-modal password="false" title="Sure to delete this trasnport?" description='Select "Delete" below if you are sure that you want delete this trasnport.' />
    

    {{-- Edit Modal --}}
    <div class="modal fade" id="edit-modal-alert" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLabel">Edit Transport</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer p-4" style="display: block">
                    <div class="row">
                        <div class="col">
                            <form id="modal-form-edit" method="post" class="my-4">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="name">Name:</label>
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Enter name">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    <button class="btn btn-secondary float-right" type="button" data-dismiss="modal">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-admin-layout>