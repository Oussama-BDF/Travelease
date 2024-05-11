<x-user-layout title='User Review'>
    <div class="container">
        <div class="row">
            <div class="col-12 p-4 bg-white shadow my-2 rounded">
                <h1>Add your review</h1>
                <form action="{{route('review.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="review">Your Review:</label>
                        <textarea class="form-control" id="review" name="review" rows="4" value='{{old("review")}}'></textarea>
                        @error('review')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label class="mb-0">Overall Rating:</label>
                        <small class="form-text text-muted mt-0 mb-3">Rate your overall experience</small>
                        <div class="rating">
                            <input type="radio" name="rating" value="5" id="5">
                            <label for="5"><i class="far fa-star"></i><i class="fas fa-star"></i></label>

                            <input type="radio"name="rating" value="4" id="4">
                            <label for="4"><i class="far fa-star"></i><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" value="3" id="3">
                            <label for="3"><i class="far fa-star"></i><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" value="2" id="2">
                            <label for="2"><i class="far fa-star"></i><i class="fas fa-star"></i></label>

                            <input type="radio" name="rating" value="1" id="1">
                            <label for="1"><i class="far fa-star"></i><i class="fas fa-star"></i></label>
                        </div>
                        @error('rating')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">Submit Review</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>