<footer class="footer-section bg-white">
    <div class="container relative">

        <div class="row g-5 mb-5">
            <div class="col-lg-6">
                <div class="mb-4 footer-logo-wrap">
                    {{-- <a class="navbar-brand footer-logo" href="{{route('home')}}">ExploreMorocco.</a> --}}
                    <a class="navbar-brand" href="{{route('home')}}"><img  width="100px" src="{{asset('img/logo-black.svg')}}" alt="..." /></a>
                </div>
                <p class="mb-4">
                    Welcome to Explore Morocco! We are passionate about 
                    creating unforgettable travel experiences that showcase 
                    the beauty and diversity of Morocco. With years of expertise 
                    in the travel industry, we specialize in curating personalized 
                    trips tailored to your unique preferences and interests.
                </p>
            </div>

            <div class="col-lg-6">
                <div class="row links-wrap">
                    <div class="col col-sm-6 col-md-3">
                        <h5>quick links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{route('about_us')}}">About us</a></li>
                            <li><a href="{{route('trips.index')}}">Trips</a></li>
                            <li><a href="{{route('reviews.index')}}">Reviews</a></li>
                            <li><a href="{{route('contact_us')}}">Contact us</a></li>
                        </ul>
                    </div>

                    <div class="col col-sm-6 col-md-3">
                        <h5>Follow us</h5>
                        <ul class="list-unstyled custom-social">
                            <li><a href="#"><i class="fab fa-brands fa-facebook-f"></i> Facebook</a></li>
                            <li><a href="#"><i class="fab fa-brands fa-twitter"></i> Twitter</a></li>
                            <li><a href="#"><i class="fab fa-brands fa-instagram"></i> Instagram</a></li>
                            <li><a href="#"><i class="fab fa-brands fa-linkedin"></i> Linkedin</a></li>
                        </ul>
                    </div>

                    <div class="col col-sm-6 col-md-6">
                        <h5>Contact</h5>
                        <ul class="list-unstyled custom-social">
                            <li><a href="#"><i class="fas  fa-phone"></i>+2120606060606</a></li>
                            <li><a href="#"><i class="fas fa-fax"></i>+2120606060606</a></li>
                            <li><a href="#"><i class="fas fa-envelope"></i>ExploreMorocco@gmail.com</a></li>
                            <li><a href="#"><i class="fas fa-map-marker-alt"></i>El Jadida - Maroc</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-top copyright">
            <div class="row pt-4">
                <div class="col-lg-6">
                    <p class="mb-2 text-center text-lg-start">
                        Copyright &copy;
                        All Rights Reserved &mdash; Explore Morocco {{now()->year}}
                    </p>
                </div>

                <div class="col-lg-6 text-center text-lg-end">
                    <ul class="list-unstyled d-inline-flex ms-auto">
                        <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>