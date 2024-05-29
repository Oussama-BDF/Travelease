<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index() {
        $reviews = Review::with('user')
            ->orderBy('id', 'desc')
            ->paginate(9);
        $reviewsAvg = number_format(Review::avg('rating'), 1);
        return view('pages.user.review.index', compact('reviews', 'reviewsAvg'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create() {
        return view('pages.user.review.create');
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request) {
        // Retrieve form data
        $formFields = $request->validate([
            'rating' => 'required',
            'review' => 'required',
        ]);

        // Check if the rating has the allowed values
        $allowed_values = [1, 2, 3, 4, 5];
        if (!in_array($formFields['rating'], $allowed_values)) {
            return back()->with('failed', 'Cannot add this review, Try Again');
        }

        // retrieve the user id
        $formFields['user_id'] = Auth::user()->id;

        // Create the review
        Review::create($formFields);

        return to_route('reviews.index')->with('success', 'Your <strong>Review</strong> Added Successfully');
    }
}
