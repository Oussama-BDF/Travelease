@props(['reviews'])
<div class="testimonial-section py-5 bg-white border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto text-center">
                <h2 class="section-title">Reviews</h2>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="testimonial-slider-wrap text-center">
                    <div id="testimonial-nav">
                        <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                        <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                    </div>

                    <div class="testimonial-slider">
                        @foreach ($reviews as $review)
                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">
                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>
                                                    <em>&ldquo;{{$review->review}}&rdquo;</em>
                                                </p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="{{ $review->user->profile_image_thumbnail ? asset('storage/' . $review->user->profile_image_thumbnail) : asset('img/default_thumbnail.png') }}"
                                                        class="rounded-circle object-fit-cover mr-3" style="width: 80px; height: 80px;" />
                                                </div>
                                                <h3 class="font-weight-bold">{{$review->user->name}}</h3>
                                                <span class="position d-block mb-3"><x-user-rating :rating="$review->rating" /></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- END item -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center my-5 read-more">
            <a href="{{route('reviews.index')}}" class="btn btn-outline-primary">View All</a>
            <hr>
        </div>
    </div>
</div>