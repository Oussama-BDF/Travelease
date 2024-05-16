<x-user-layout title='Reviews'>
    <div class="container  py-5">
        <div class="row">
            <div class="col-12 p-4 my-2">
                <div class="text-center m-auto" style="width: 60%">
                    <h3 class="mb-4 font-weight-bold">Users Reviews</h3>
                    <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, 
                        sed diam nonumy eirmod tempor invidunt ut labore et dolore 
                        magna aliquyam erat, sed diam voluptua. At vero eos et accusam 
                        et justo duo dolores et ea rebum. Stet clita kasd gubergren, no 
                        sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum 
                        dolor sit amet, consetetur sadipscing elitr.
                    </p>
                    <div class="rating-total">
                        <div class="rating-total-value">{{$reviewsAvg}} / 5.0</div>
                        <div class="rating-total-stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    </div>
                </div>
                <hr>
-                <h5 class="text-dark font-weight-bold h4 mb-0">All Ratings and Reviews</h5>
                @foreach ($reviews as $review)
                    <div class="user-review pt-4 pb-4">
                        <div class="media">
                            <img src="{{asset('storage/'.($review->user->profile_image_thumbnail ?? 'profile/thumbnails/default.png'))}}" class="rounded-circle object-fit-cover mr-3" style="width: 60px; height: 60px;"  />
                            <div class="media-body">
                                <div class="user-review-header">
                                    <h6 class="mb-1">
                                        <a class="text-black" href="#">{{$review->user->name}}</a>
                                        <x-user-rating :rating="$review->rating" />
                                    </h6>
                                    <p class="text-gray">{{date('D, d M Y', strtotime($review->created_at))}}</p>
                                </div>
                                <div class="user-review-body">
                                    <p>{{$review->review}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
        {{$reviews->links()}}
    </div>
</x-user-layout>