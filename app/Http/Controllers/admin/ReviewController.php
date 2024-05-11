<?php

namespace App\Http\Controllers\admin;

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
        $reviews = Review::orderBy('id', 'desc')->get();
        $reviewsAvg = number_format(Review::avg('rating'), 1);
        return view('pages.admin.review.index', compact('reviews', 'reviewsAvg'));
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return to_route('admin.reviews.index')->with('success', 'The <strong>Review</strong> Deleted Successfully');
    }
}
