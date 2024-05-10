<x-user-layout title='Edit Profile'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <form action="{{route('profile.update')}}" method="post" enctype='multipart/form-data'>
                    @csrf
                    @method('PATCH')
                    <p class="text-dark font-weight-bold h4 mb-0">Profile Information</p>
                    <small class="form-text text-muted mb-3">Update Your account's profile information and email address.</small>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name', Auth::user()->name)}}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email', Auth::user()->email)}}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone-number">Phone number:</label>
                        <input class="form-control" type="text" id="phone-number" name="phone_number" placeholder="Enter phone number" value="{{old('phone_number', Auth::user()->phone_number)}}">
                        @error('phone_number')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="address">Address:</label>
                        <input class="form-control" type="text" id="address" name="address" placeholder="Enter address" value="{{old('address', Auth::user()->address)}}">
                        @error('address')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <label for="image">Profile Image:</label>
                        <input class="form-control-file" type="file" id="image" name="profile_image" placeholder="Select an image">
                        @if($image = Auth::user()->profile_image_thumbnail)
                            <div class="bg-dark" style="width: 100px">
                                <img src="{{ asset('storage/'.$image) }}" style="width: 100px" class="" alt="...">
                            </div>
                        @endif
                        @error('image')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <form action="{{route('password.update')}}" method="post">
                    @csrf
                    @method('PATCH')
                    <p class="text-dark font-weight-bold h4 mb-0">Update Password</p>
                    <small class="form-text text-muted mb-3">Ensure your account is using a long, random password to stay secure.</small>
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        @error('current_password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>

            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <p class="text-dark font-weight-bold h4 mb-0">Delete Account</p>
                <small class="form-text text-muted mb-3">Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</small>
                <small class="form-text text-muted mb-3">Please enter your password to confirm you would like to permanently delete your account.</small>
                @error('your_password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#deleteAccountModal">
                    Delete
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete your account?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</div>
                <div class="footer p-4">
                    <form action="{{route('profile.destroy')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <input type="password" class="form-control" name="your_password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button class="btn btn-secondary float-right" type="button" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>