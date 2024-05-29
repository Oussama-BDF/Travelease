<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Explore Morocco - Login</title>
        {{-- @vite(['resources/scss/app.scss']) --}}
        <link rel="stylesheet" href="{{asset('build/assets/app.min.css')}}">
    </head>

    <body class="bg-gradient-primary">

        <div class="container login">
    
            <!-- Outer Row -->
            <div class="row justify-content-center align-items-center h-100">
    
                <div class="col-xl-10 col-lg-12 col-md-9">
    
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background: url('{{asset('img/hero.jpg')}}') no-repeat center/cover; position: relative;">
                                    <div class="overlay"></div> <!-- Overlay div -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                        </div>
                                        <form class="user" action="{{route('admin.login')}}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" name="email" class="form-control form-control-user"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Enter Email Address..." value={{old('email')}}>
                                                @error('email')
                                                    <small class="text-danger">{{$message}}</small>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user"
                                                    id="exampleInputPassword" placeholder="Password">
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                                    <label class="custom-control-label" for="remember">Remember Me</label>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
    </body>
</html>