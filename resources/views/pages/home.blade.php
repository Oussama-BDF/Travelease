Welcome to the home page
<hr>
@auth
    @role('user')
        Hi {{Auth::user()->name}}
        <img src="{{asset("storage/".Auth::user()->profile_image)}}" alt="No image">
    @endrole
@endauth