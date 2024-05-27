<x-admin-layout title='Edit Profile'>
    <x-slot name="header">Edit Profile</x-slot>
    <!-- Content Row -->
    <div class="row my-4">
        <div class="col-12 p-4 bg-white shadow rounded">
            <form action="{{route('admin.profile.update')}}" method="post" enctype='multipart/form-data'>
                @csrf
                @method('PATCH')
                <p class="text-dark font-weight-bold text-lg mb-0">Profile Information</p>
                <small class="form-text text-muted mb-3">Update Your account's profile information and email address.</small>

                <div class="form-group mb-3">
                    {{-- Old Image View --}}
                    @if ($image =  Auth::user()->profile_image)
                        <small class="text-danger">You can change the profile image by uploading a new one, or you can delete it by checking it!</small>
                    @endif
                    <div class="image_view profile show">
                        @if ($image)
                            <input class="image_delete" type="checkbox" name="delete_image">
                        @endif
                        <img src="{{ $image ? asset('storage/' . $image) : asset('img/default.png') }}"
                            class="object-fit-cover preview show" style="width: 250px; height: 250px;" />
                    </div>
                    {{-- Upload Image View --}}
                    <div class="uploaded_image_view profile">
                        <span class="image_remove d-flex justify-content-center align-items-center bg-danger"><i class="fa fa-solid fa-trash"></i></span>
                        <img class="object-fit-cover preview" style="width: 250px; height: 250px;" src="#">
                    </div>
                    {{-- Upload Image Button --}}
                    <div class="btn_upload profile">
                        <input class="image_upload" type="file" name="profile_image">
                        <i class="fa fa-solid fa-camera"></i> Upload Image
                    </div>
                    @error('image')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>

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
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-12 p-4 bg-white shadow rounded">
            <form action="{{route('admin.password.update')}}" method="post">
                @csrf
                @method('PATCH')
                <p class="text-dark font-weight-bold text-lg mb-0">Update Password</p>
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
    </div>
</x-admin-layout>