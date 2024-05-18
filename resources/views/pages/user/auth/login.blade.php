<x-user-layout title='Login'>
    <div class="container py-5">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <h1>Login</h1>
                <div class="my-3"><a class="btn btn-outline-primary" href="{{route('registerForm')}}">Create An Account?</a></div>
                <form action="{{route('login')}}" method="post">
                    @csrf
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
                    </div>      
                    <button type="submit" class="btn btn-outline-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>