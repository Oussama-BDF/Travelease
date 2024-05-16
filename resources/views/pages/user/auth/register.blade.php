<x-user-layout title='Register'>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <h1>Register</h1>
                <div class="my-3"><a href="{{route('loginForm')}}" class="btn btn-outline-primary">Already have an account?</a></div>
                <form action="{{route('register')}}" method="post" enctype='multipart/form-data'>
                    @csrf

                    <div class="form-group mb-3">
                        {{-- Default Image View --}}
                        <div class="image_view show">
                            <img class="object-fit-cover preview show" style="width: 250px; height: 250px;" src="{{ asset('storage/'. 'profile/default.png') }}">
                        </div>
                        {{-- Upload Image View --}}
                        <div class="uploaded_image_view">
                            <span class="image_remove d-flex justify-content-center align-items-center bg-danger"><i class="fa fa-solid fa-trash"></i></span>
                            <img class="object-fit-cover preview" style="width: 250px; height: 250px;" src="#">
                        </div>
                        {{-- Upload Image Button --}}
                        <div class="btn_upload">
                            <input class="image_upload" type="file" name="profile_image">
                            <i class="fa fa-solid fa-camera"></i> Upload Image
                        </div>
                        @error('image')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

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

                    <button type="submit" class="btn btn-outline-primary">register</button>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>