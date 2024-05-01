@props(['key', 'id'])
<div class="row align-items-center">
    <div class="col-md">
        <div class="form-group mb-3">
            <input class="form-control" type="file" name="image{{$key}}" multiple>
            <input type="hidden" name="id{{$key}}" value="{{$id}}">
            @error('image' .$key)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>