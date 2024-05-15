<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Trip;


class HomeController extends Controller
{
    public function index() {
        $reviews = Review::limit(5)->get();
        $trips = Trip::limit(3)->orderby('id', 'desc')->get();
        return view('pages.user.home', compact('reviews', 'trips'));
    }
}