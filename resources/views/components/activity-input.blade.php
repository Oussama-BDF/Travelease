@props(['activity_price', 'activity_name', 'key'])
<div class="row align-items-center">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label>Activity Price:</label>
            <input class="form-control" type="text" name="activity_price[]" placeholder="Enter activity price" value="{{$activity_price}}">
            @error('activity_price.' .$key)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col">
        <div class="form-group mb-3">
            <label>Activity Name:</label>
            <input class="form-control" type="text" name="activity_name[]" placeholder="Enter activity name" value="{{$activity_name}}">
            @error('activity_name.' .$key)
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <button onclick="removeActivity(this)" id="delete-activity" type="button" class="delete-activity col-auto btn btn-danger rounded-circle">X</button>
</div>