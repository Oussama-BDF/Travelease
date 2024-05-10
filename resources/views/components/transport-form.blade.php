@props(['isUpdate', 'transport'])
@php
    $route = route('admin.transports.store');
    if ($isUpdate) {
        $route = route('admin.transports.update', $transport->id);
    }
@endphp
<div class="col">
    <form action="{{$route}}" method="post" class="my-4">
        @csrf
        @if($isUpdate)
            @method('PUT')
        @endif
        <div class="form-group mb-3">
            <label for="name">Name:</label>
            <input class="form-control" type="text" id="name" name="name" placeholder="Enter name" value='{{old("name", $transport->name)}}'>
            @error('name')
                <div class="text-danger">{{$message}}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">{{$isUpdate? 'Edit':'Add'}}</button>
            <input type="reset" class="btn btn-primary float-right" value="Reset">
        </div>
    </form>
</div>