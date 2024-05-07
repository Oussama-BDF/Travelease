<x-user-layout title='home'>
    Welcome to the home page
    <hr>
    @auth
        @role('user')
            Hi {{Auth::user()->name}}
            <img src="{{asset("storage/". (Auth::user()->profile_image_thumbnail ?? 'profile/thumbnails/default.png'))}}" alt="No image">
        @endrole
    @endauth
</x-user-layout>