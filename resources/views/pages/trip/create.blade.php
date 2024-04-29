<x-master title='Add Trip'>
    <div class="container">
        <h1 class="my-4">Add Trip</h1>
        <a href="{{route('trips.index')}}" class="btn btn-secondary">Back</a>
        <form action="{{route('trips.store')}}" method="post" class="my-4">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="destination">Destination:</label>
                        <input class="form-control" type="text" id="destination" name="destination" placeholder="Enter destination" value='{{old("destination")}}'>
                        @error('destination')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="start">Start At:</label>
                        <input class="form-control" type="date" id="start" name="start_at" placeholder="Select start date" value='{{old("start_at")}}'>
                        @error('start_at')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="end">End At:</label>
                        <input class="form-control" type="date" id="end" name="end_at" placeholder="Select end date" value='{{old("end_at")}}'>
                        @error('end_at')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="transport_id">Transport:</label>
                        <select class="form-control" id="transport_id" name="transport_id">
                            <option value="">Select Transport</option>
                            @foreach($transports as $transport)
                                <option @selected($transport->id == old('transport_id')) value="{{ $transport->id }}">{{ $transport->name }} - {{$transport->category}}</option>
                            @endforeach
                        </select>
                        @error('transport_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="accommodation">Accommodation:</label>
                        <input class="form-control" type="text" id="accommodation" name="accommodation" placeholder="Enter accommodation" value='{{old("accommodation")}}'>
                        @error('accommodation')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label for="price">Price:</label>
                        <input class="form-control" type="text" id="price" name="price" placeholder="Enter price" value='{{old("price")}}'>
                        @error('price')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description" cols="30" rows="1">{{old("description")}}</textarea>
                        @error('description')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <h4>Activities :</h4>
            <button id="add-activity" type="button" class="btn btn-primary rounded-circle">+</button>
            <div id="activity-container">
                @error('activity_price.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('activity_name.*')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

                @foreach(old("activity_name") ?? [] as $key => $activity_name)
                    <x-activity-input :key="$key"  :activity_price="old('activity_price.' . $key)" :activity_name="$activity_name" />
                @endforeach
            </div>
            <div class="d-flex justify-content-between my-2">
                <button type="submit" class="btn btn-primary">Add</button>
                <input type="reset" class="btn btn-primary float-right" value="Reset">
            </div>
        </form>
    </div>
</x-master>
