<x-admin-layout title='Edit Trip'>
    <x-slot name="header">Edit Trip</x-slot>
    <!-- Content Row -->
    <div class="row">
        {{-- <x-trip-form :isUpdate="$isUpdate" :trip="$trip" :transports="$transports" /> --}}
        <div class="col p-4 bg-white shadow my-2 rounded">
            <form action="{{route('admin.trips.update', $trip->uuid)}}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="destination">Destination:</label>
                            <input class="form-control" type="text" id="destination" name="destination" placeholder="Enter destination" value='{{old("destination", $trip->destination)}}'>
                            @error('destination')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start">Start At:</label>
                            <input class="form-control" type="date" id="start" name="start_at" placeholder="Select start date" value='{{old("start_at", $trip->start_at)}}'>
                            @error('start_at')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end">End At:</label>
                            <input class="form-control" type="date" id="end" name="end_at" placeholder="Select end date" value='{{old("end_at", $trip->end_at)}}'>
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
                                    <option @selected($transport->id == old('transport_id', $trip->transport_id)) value="{{ $transport->id }}">{{ $transport->name }}</option>
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
                            <input class="form-control" type="text" id="accommodation" name="accommodation" placeholder="Enter accommodation" value='{{old("accommodation", $trip->accommodation)}}'>
                            @error('accommodation')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input class="form-control" type="text" id="price" name="price" placeholder="Enter price" value='{{old("price", $trip->price)}}'>
                            @error('price')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Enter description" cols="30" rows="1">{{old("description", $trip->description)}}</textarea>
                            @error('description')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="max_travelers">Travelers Number:</label>
                            <input class="form-control" type="number" id="max_travelers" name="max_travelers" placeholder="Enter travelers number" value='{{old("max_travelers", $trip->max_travelers)}}'>
                            @error('max_travelers')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <label>Activities :</label>
                <button id="add-activity" type="button" class="btn btn-primary rounded-circle">+</button>
                <div id="activity-container">
                    @foreach($trip->activities as $key => $activity)
                        <x-activity-input :key="$key" :activity_price="old('activity_price.' . $key, $activity->price)" :activity_name="old('activity_name.' . $key, $activity->name)" />
                    @endforeach
                    @foreach(old("activity_name") ?? [] as $key => $activity_name)
                        @if( $key >= $trip->activities->count() )
                            <x-activity-input :key="$key" :activity_price="old('activity_price.' . $key)" :activity_name="$activity_name" />
                        @endif
                    @endforeach
                </div>
                
                <label>Images : <small class="text-danger">You can change the image by uploading a new one, or you can delete it by checking it!</small></label>
                <div class="row">
                    @foreach($trip->images as $key => $image)
                        <div class="col-md-4">
                            <x-upload-image :key="$key+1" />
                            {{-- Old Image View --}}
                            <div class="image_view trip show">
                                <input class="image_delete" type="checkbox" name="delete_image{{$key+1}}">
                                <img class="object-fit-cover preview show" style="width: 250px; height: 250px;" src="{{ asset('storage/'.$image->path) }}">
                            </div>
                            <input type="hidden" name="id{{$key+1}}" value="{{$image->id}}">
                            @error('image' .$key+1)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                    @for($i=count($trip->images)+1; $i<=3; $i++)
                        <div class="col-md-4">
                            <x-upload-image :key="$i" />
                            @error('image' .$i)
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    @endfor
                </div>

                <div class="d-flex justify-content-between my-2">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <input type="reset" class="btn btn-primary float-right" value="Reset">
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
