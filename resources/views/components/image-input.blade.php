@props(['key', 'id', 'isUpdate'])
<div class="row align-items-center">
    <div class="col-md">
        <div class="form-group mb-3">
            <input class="form-control" type="file" name="image{{$key}}">
            <input type="hidden" name="id{{$key}}" value="{{$id}}">
            @error('image' .$key)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    @if ($isUpdate)
        <div class="col-auto btn btn-danger">
            Delete <input class="" onchange="deleteImage(this)" type="checkbox" name="delete_image[]" value="{{ $id }}">
        </div>
    @endif
</div>