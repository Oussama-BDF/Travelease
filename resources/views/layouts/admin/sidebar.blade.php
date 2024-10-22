<style>
    /* .icon {
        display: inline-block !important;
        font-size: 1.1rem !important;
        width: .9em;
        height: .9em;
        background-color: currentColor;
        mask-size: contain;
        mask-repeat: no-repeat;
        mask-position: center;
        -webkit-mask-size: contain;
        -webkit-mask-repeat: no-repeat;
        -webkit-mask-position: center;
        margin-right: .25rem;
        color: white;
    }

    .icon ~ span {
        vertical-align: text-top;
    }

    .tachometer {
        mask-image: url({{asset('svgs/tachometer.svg')}});
        -webkit-mask-image: url({{asset('svgs/tachometer.svg')}});
    } */
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.dashboard')}}">
        <div class="sidebar-brand-icon">
			<img src="{{asset('img/logo-white.svg')}}" alt="..." />
        </div>
        <div class="sidebar-brand-text mx-3">Explore Morocco</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            {{-- <span class="icon tachometer"></span> --}}
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manage
    </div>

    <!-- Nav Item - Manage Trips -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-plane-departure"></i>
            <span>Manage Trips</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{route('admin.trips.index')}}">All Trips</a>
                <a class="collapse-item" href="{{route('admin.trips.create')}}">Add Trip</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Manage Transports -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-shuttle-van"></i>
            <span>Manage Transports</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{route('admin.transports.index')}}">All Transports</a>
                <a class="collapse-item" href="{{route('admin.transports.create')}}">Add Transport</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Manage Users -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.users.index')}}">
            <i class="fas fa-users"></i>
            <span>Manage Users</span>
        </a>
    </li>
    
    <!-- Nav Item - Manage Booking -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-clipboard-list"></i>
            <span>Manage Bookings</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{route('admin.bookings.pending')}}">Pending Bookings</a>
                <a class="collapse-item" href="{{route('admin.bookings.confirmed')}}">Confirmed Bookings</a>
                <a class="collapse-item" href="{{route('admin.bookings.canceled')}}">Canceled Bookings</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Manage Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.reviews.index')}}">
            <i class="fas fa-comments"></i>
            <span>Manage Reviews</span>
        </a>
    </li>

    <!-- Nav Item - Manage Reviews -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin.contacts.index')}}">
            <i class="fas fa-comments"></i>
            <span>Contact messages</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>