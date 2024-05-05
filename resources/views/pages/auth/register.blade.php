<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Travel Ease - Login</title>
        <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
        <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body id="page-top">
        <div class="container">
            <h1>register</h1>
            <a href="{{route('loginForm')}}" class="btn btn-primary">Already have an account?</a>
            <form action="{{route('register')}}" method="post">
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
                <button type="submit" class="btn btn-primary">register</button>
            </form>
        </div>
    </body>
</html>