<x-user-layout title='home'>
	<!-- Hero Section -->
	<x-home.hero />

	<!-- About us Section -->
	<x-home.about-us />

	<!-- Let Us Section -->
	<x-home.let-us />

	<!-- Last Trips Section -->
	<x-home.last-trips :trips="$trips"/>

	<!-- Reviews Slider -->
	<x-home.reviews :reviews="$reviews"/>
</x-user-layout>

{{--
Top Places Around Morroco/Destinations

Activies
--}}