<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">Travel Ease</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('trips.index')}}">Trips</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('transports.index')}}">Transports</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
