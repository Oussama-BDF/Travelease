@props(['key', 'id', 'isUpdate'])
<div class="form-group">
    <input class="form-control-file" type="file" name="image{{$key}}">
    <input type="hidden" name="id{{$key}}" value="{{$id}}">
    @error('image' .$key)
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
@if ($isUpdate)
    <div class="col-auto btn btn-danger">
        Delete <input class="" onchange="deleteImage(this)" type="checkbox" name="delete_image[]" value="{{ $id }}">
    </div>
@endif