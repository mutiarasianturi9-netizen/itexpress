<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
{
    $request->validate([

        'order_id' => 'required',
        'rating' => 'required',
        'comment' => 'required',

    ]);

    Review::create([

        'order_id' => $request->order_id,

        'rating' => $request->rating,

        'comment' => $request->comment,

    ]);

    return back()->with('success', 'Ulasan berhasil dikirim');
}
public function review()
{
    $reviews = Review::with('order.user')
        ->latest()
        ->get();

    return view('review', compact('reviews'));
}
}