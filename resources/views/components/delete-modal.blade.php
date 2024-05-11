@props(['title', 'description', 'password'])
<div class="modal fade" id="delete-modal-alert" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">{{$title}}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">{{$description}}</div>
            <div class="modal-footer p-4" style="display: block">
                <form id="modal-form" method="post">
                    @csrf
                    @method('DELETE')
                    @if ($password == "true")
                        <div class="form-group">
                            <input type="password" class="form-control" name="your_password" placeholder="Password">
                        </div>
                    @endif
                    <button class="btn btn-danger" type="submit">Delete</button>
                    <button class="btn btn-secondary float-right" type="button" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>