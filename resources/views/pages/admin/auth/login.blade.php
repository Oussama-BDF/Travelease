<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Travel Ease - Login</title>
        <link rel="stylesheet" href="{{asset('css/app.min.css')}}">
        <link href="{{asset('css/all.min.css')}}" rel="stylesheet" type="text/css">
        @vite(['resources/scss/app.scss'])
    </head>
    <body id="page-top">
        <div class="container">
            <h1>Login</h1>
            <form action="{{route('admin.login')}}" method="post">
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
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </body>
</html>