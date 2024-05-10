<x-user-layout title='Register'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <h1>Register</h1>
                <a href="{{route('loginForm')}}" class="btn btn-primary">Already have an account?</a>
                <form action="{{route('register')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" id="name" name="name" placeholder="Enter full name" value='{{old("name")}}'>
                        @error('name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Enter email" value='{{old("email")}}'>
                        @error('email')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter password">
                        @error('password')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="re-password">Password Confirmation:</label>
                        <input class="form-control" type="password" id="re-password" name="password_confirmation" placeholder="Confirm password">
                        @error('password_confirmation')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone-number">Phone number:</label>
                        <input class="form-control" type="text" id="phone-number" name="phone_number" placeholder="Enter phone number" value='{{old("phone_number")}}'>
                        @error('phone_number')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="Enter address" value='{{old("address")}}'>
                        @error('address')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Profile Image:</label>
                        <input class="form-control-file" type="file" id="image" name="profile_image" placeholder="Select an image">
                        @error('image')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">register</button>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>