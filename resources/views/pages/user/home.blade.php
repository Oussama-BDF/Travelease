<x-user-layout title='home'>
	<!-- Hero Section -->
	<x-home.hero />

	<!-- Last Trips Section -->
	<x-home.last-trips :trips="$trips"/>

	<!-- About us Section -->
	<x-home.about-us />

	<!-- Let Us Section -->
	<x-home.let-us />

	<!-- Reviews Slider -->
	<x-home.reviews :reviews="$reviews"/>

	<!-- Contact Us Section -->
	<x-home.contact-us />
</x-user-layout>