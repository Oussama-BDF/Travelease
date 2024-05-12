<x-user-layout title='Edit Profile'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <form action="{{route('bookings.store', $trip->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="adults_number">Adults Number</label>
                        <input type="number" class="form-control" id="adults_number" name="adults_number" placeholder="Enter adults number" value="{{old('adults_number', 1)}}">
                        @error('adults_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="children_number">Children Number</label>
                        <input type="number" class="form-control" id="children_number" name="children_number" placeholder="Enter your children Number" value="{{old('children_number', 0)}}">
                        @error('children_number')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="emergency_contact">Emergency Contact</label>
                        <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" placeholder="Enter your emergency contact" value="{{old('emergency_contact')}}">
                        @error('emergency_contact')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Confirm Booking?</button>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>