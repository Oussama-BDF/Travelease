@props(['trips'])
<div class="last-trips-section py-5 bg-gray border-bottom">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Last Trips</h2>
            </div>
        </div>

        <div class="row">
            @foreach ($trips as $trip)
                <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                    <div class="post-entry">
                        <a href="{{route('trips.show', $trip->id)}}" class="post-thumbnail"><img src="{{asset('storage/'.$trip->images->first()->path)}}" alt="Image"
                            class="card-img-top object-fit-cover img-card" /></a>
                        <div class="post-content-entry">
                            <h3>
                                <span>To : {{$trip->destination}}</span>
                                <span class="float-right text-primary">{{$trip->price}} MAD</span>
                            </h3>
                            <div class="meta">
                                <span>start at {{$trip->start_at}}</span>
                                <span class="float-right">end at {{$trip->end_at}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-center my-5 read-more">
            <a href="{{route('trips.index')}}" class="btn btn-outline-primary">View All</a>
            <hr>
        </div>
    </div>
</div>