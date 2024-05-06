Welcome to the home page
<hr>
@auth
    @role('user')
        Hi {{Auth::user()->name}}
    @endrole
@endauth