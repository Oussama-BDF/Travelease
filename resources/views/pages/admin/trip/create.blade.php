<x-admin-layout title='Add Trip'>
    <x-slot name="header">Add Trip</x-slot>
    <!-- Content Row -->
    <div class="row">
        {{-- <x-trip-form :isUpdate="$isUpdate" :trip="$trip" :transports="$transports"/> --}}
        <div class="col p-4 bg-white shadow my-2 rounded">
            <form action="{{route('admin.trips.store')}}" method="post" enctype='multipart/form-data'>
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destination">Destination:</label>
                            <input class="form-control" type="text" id="destination" name="destination" placeholder="Enter destination" value='{{old("destination")}}'>
                            @error('destination')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">Start At:</label>
                            <input class="form-control" type="date" id="start" name="start_at" placeholder="Select start date" value='{{old("start_at")}}'>
                            @error('start_at')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End At:</label>
                            <input class="form-control" type="date" id="end" name="end_at" placeholder="Select end date" value='{{old("end_at")}}'>
                            @error('end_at')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transport_id">Transport:</label>
                            <select class="form-control" id="transport_id" name="transport_id">
                                <option value="">Select Transport</option>
                                @foreach($transports as $transport)
                                    <option @selected($transport->id == old('transport_id')) value="{{ $transport->id }}">{{ $transport->name }}</option>
                                @endforeach
                            </select>
                            @error('transport_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="accommodation">Accommodation:</label>
                            <input class="form-control" type="text" id="accommodation" name="accommodation" placeholder="Enter accommodation" value='{{old("accommodation")}}'>
                            @error('accommodation')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input class="form-control" type="text" id="price" name="price" placeholder="Enter price" value='{{old("price")}}'>
                            @error('price')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" cols="30" rows="1">{{old("description")}}</textarea>
                            @error('description')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <label>Activities :</label>
                <button id="add-activity" type="button" class="btn btn-primary rounded-circle">+</button>
                <div id="activity-container">
                    @foreach(old("activity_name") ?? [] as $key => $activity_name)
                        <x-activity-input :key="$key" :activity_price="old('activity_price.' . $key)" :activity_name="$activity_name" />
                    @endforeach
                </div>

                <label>Images :</label>
                <div class="row">
                    @for($i=1; $i<=3; $i++)
                        <div class="col-md-4">
                            <x-upload-image :key="$i" />
                            @error('image' .$i)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor
                </div>

                <div class="d-flex justify-content-between my-2">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <input type="reset" class="btn btn-primary float-right" value="Reset">
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>